<?php

namespace Database\Seeders;

use App\Models\Question as ModelsQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Question extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question' => 'Hiện tại bạn đang sử dụng điện thoại gì?',
            ],
            [
                'question' => 'Bạn quan tâm đến dòng sản phẩm nào?',
            ],
            [
                'question' => 'Bạn thích nhận được ưu đãi nào sau đây?',
            ],
            [
                'question' => 'Bạn quan tâm đến tính năng trí tuệ nhân tạo?',
            ],
            [
                'question' => 'Bạn có hứng thú với việc sử dụng S Pen khi làm việc và giải trí không?',
            ]
        ];

        ModelsQuestion::insert($questions);
    }
}
