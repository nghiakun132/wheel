<?php

namespace App\Exports;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSurvey implements FromQuery, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */


    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return User::where('shop_name', '<>', config('app.admin.name'))->with(['survey.question', 'survey.answer', 'reward.reward']);
    }

    public function headings(): array
    {
        return [
            'id',
            'Tên cửa hàng',
            'Tên khách hàng',
            'Email',
            'Số điện thoại',
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
            $user->reward->reward->shop_name,
            $user->name,
            $user->email,
            $user->phone,
            Arr::get($arrayAnswer, 'cau_1'),
            Arr::get($arrayAnswer, 'cau_2'),
            Arr::get($arrayAnswer, 'cau_3'),
            Arr::get($arrayAnswer, 'cau_4'),
            Arr::get($arrayAnswer, 'cau_5'),
            $user->reward->reward->reward_name,
            $user->created_at,
        ];
    }
}
