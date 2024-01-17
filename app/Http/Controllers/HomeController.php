<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::with('answers')->get();
        $rewards = Reward::all();

        $backgrounds = [
            1 => '#1abc9c',
            2 => '#6aabd5',
            3 => '#e67e22',
            4 => '#9b59b6',
        ];

        $listRewardHaveQuantity = [];


        foreach ($rewards as $key => $value) {
            if ($value->reward_quantity > 0) {
                $listRewardHaveQuantity[] = $value;
            }

            $value->background = $backgrounds[$value->id];
        }
        $rewardIds = $rewards->pluck('id')->toArray();
        $listRewardHaveQuantity = (Arr::pluck($listRewardHaveQuantity, 'id'));

        $randomProduct = $this->getRandomProductExcluding($rewardIds, $listRewardHaveQuantity);


        return view('index', compact('questions', 'rewards', 'randomProduct'));
    }

    protected function getRandomProductExcluding($products, $excludedIds)
    {
        // Lọc ra các sản phẩm không bị loại bỏ
        $availableProducts = array_filter($products, function ($product) use ($excludedIds) {
            return in_array($product, $excludedIds);
        });

        // Lấy một sản phẩm ngẫu nhiên từ danh sách đã lọc
        $randomProduct = $availableProducts[array_rand($availableProducts)];

        return $randomProduct;
    }

}
