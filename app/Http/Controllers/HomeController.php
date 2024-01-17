<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('index');
        }

        return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');
    }


    public function index()
    {
        $questions = Question::with('answers')->get();
        $rewards = Reward::where('shop_name', auth()->user()->name)->get();

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

            $value->background = $backgrounds[$key + 1];
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
