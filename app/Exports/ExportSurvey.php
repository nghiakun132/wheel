<?php

namespace App\Exports;

use App\Models\Admin;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSurvey implements FromQuery, WithHeadings, WithMapping
{

    protected $query;
    public function __construct(array $query)
    {
        $this->query = $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */


    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        $shop = Admin::where('name', '<>', config('app.admin.name'))->pluck('name')->toArray();

        $query = User::whereIn('shop_name', $shop)
            ->where('shop_name', '<>', config('app.admin.name'));

        if (!empty($this->query['store'])) {
            $query = $query->where('shop_name', $this->query['store']);
        }

        if (!empty($this->query['date'])) {
            $query = $query->whereDate('created_at', $this->query['date']);
        }

        return $query->with(['survey.question', 'survey.answer', 'reward.reward']);
    }

    public function headings(): array
    {
        return [
            'id',
            'Tên cửa hàng',
            'Tên khách hàng',
            'Email',
            'Số điện thoại',
            'Giới tính',
            'Tuổi',
            'Câu 1',
            'Câu 2',
            'Câu 3',
            'Câu 4',
            'Câu 5',
            'Quà tặng',
            'Ngày tạo',
        ];
    }

    public function map($user): array
    {
        $arrayAnswer = [];
        $answer = $user->survey;

        foreach ($answer as $key => $value) {
            $arrayAnswer['cau_' . $value->question_id] = $value->answer->answer;
        }

        return [
            $user->id,
            $user->shop_name,
            $user->name,
            $user->email,
            $user->phone,
            $user->sex,
            $user->age,
            Arr::get($arrayAnswer, 'cau_1'),
            Arr::get($arrayAnswer, 'cau_2'),
            Arr::get($arrayAnswer, 'cau_3'),
            Arr::get($arrayAnswer, 'cau_4'),
            Arr::get($arrayAnswer, 'cau_5'),
            $user->reward ? ($user->reward->reward ? $user->reward->reward->reward_name : '') : '',
            $user->created_at,
        ];
    }
}
