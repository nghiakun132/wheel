<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        $questions = Question::with('answers')->get();
        $rewards = Reward::where('shop_name', auth()->user()->name)->get();

        $listRewardHaveQuantity = [];


        foreach ($rewards as $key => $value) {
            if ($value->reward_quantity > 0) {
                $listRewardHaveQuantity[] = $value;
            }
        }
        $rewardIds = $rewards->toArray();
      
        $listRewardHaveQuantity = (Arr::pluck($listRewardHaveQuantity, 'id'));

        $randomProducts = $this->getRandomProductExcluding($rewardIds, $listRewardHaveQuantity);
        $randomProduct = $randomProducts['id'];
     
        $image = asset($randomProducts['images']);

        $name = $randomProducts['reward_name'];

        return view('index', compact('questions', 'rewards', 'randomProduct', 'image', 'name'));
    }

    function getRandomProductExcluding($products, $excludedIds)
    {
        // Lọc ra những sản phẩm có số lượng lớn hơn 0 và không nằm trong danh sách loại trừ
        $availableProducts = array_filter($products, function ($product) use ($excludedIds) {
            return $product['reward_quantity'] > 0 && in_array($product['id'], $excludedIds);
        });

        // Tính tổng số lượng
        $totalQuantity = array_sum(array_column($availableProducts, 'reward_quantity'));
  
        // Tính tỉ lệ phần trăm cho từng sản phẩm dựa trên số lượng giảm dần
        $tilesanpham = array_map(function ($product) use ($totalQuantity) {
            return $product['reward_quantity'] / $totalQuantity;
        }, $availableProducts);

        $randomNumber =  rand(0, 100) / 100;
   
        // Chọn sản phẩm dựa trên số ngẫu nhiên
        $cumulativePercentage = 0;
        foreach ($tilesanpham as $index => $tile) {
            $cumulativePercentage += $tile;
            if ($randomNumber <= $cumulativePercentage) {
                return $availableProducts[$index];
            }
        }

        return null;
    }
}
