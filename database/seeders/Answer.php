<?php

namespace Database\Seeders;

use App\Models\Answer as ModelsAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Answer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $arrayAnswers = [
            1 => [
                "Galaxy",
                "Iphone",
                "Khác"
            ],
            2 => [
                "Điện thoại thường",
                "Điện thoại gập",
                "Laptop",
                "Máy tính bảng",
                "Đồng hồ thông minh",
                "Buds (Tai nghe không dây)",
                "TV",
                "Robot hút bụi",
            ],
            3 => [
                "Thu cũ đổi mới",
                "Nâng cấp bộ nhớ",
                "Chương trình bảo hành",
                "Voucher"
            ],
            4 => [
                "Chụp ảnh",
                "Chỉnh sửa ảnh",
                "Tìm kiếm thông tin",
                "Phiên dịch"
            ],
            5 => [
                "Có",
                "Không"
            ],
        ];


        $answers = [];

        foreach ($arrayAnswers as $key => $value) {
            foreach ($value as $answer) {
                $answers[] = [
                    'question_id' => $key,
                    'answer' => $answer,
                ];
            }
        }

        ModelsAnswer::insert($answers);
    }
}
