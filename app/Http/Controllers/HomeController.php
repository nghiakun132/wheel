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
        $rewardIds = $rewards->pluck('id')->toArray();
        $listRewardHaveQuantity = (Arr::pluck($listRewardHaveQuantity, 'id'));

        $randomProduct = $this->getRandomProductExcluding($rewardIds, $listRewardHaveQuantity);

        $rw = Reward::where('id', $randomProduct)->first();

        $image = asset($rw->images);

        $name = $rw->reward_name;

        return view('index', compact('questions', 'rewards', 'randomProduct', 'image', 'name'));
    }

    protected function getRandomProductExcluding($products, $excludedIds)
    {
        $availableProducts = array_filter($products, function ($product) use ($excludedIds) {
            return in_array($product, $excludedIds);
        });

        $randomProduct = $availableProducts[array_rand($availableProducts)];

        return $randomProduct;
    }
}
