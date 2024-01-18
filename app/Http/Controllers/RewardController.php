<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::where('shop_name', '<>', config('app.admin.name'))
            ->get();

        $rewards = $rewards->groupBy('shop_name');

        return view('admin.reward.index', compact('rewards'));
    }

    public function update(Request $request)
    {
        $reward = Reward::find($request->id);
        $reward->reward_quantity = $request->reward_quantity;

        $reward->save();

        return redirect()->route('admin.reward.index');
    }

    public function rewarded()
    {
        $rewards = Reward::
            where('shop_name', '<>', config('app.admin.name'))
            ->withCount('rewarded')->get();

        $rewards = $rewards->groupBy('shop_name');

        return view('admin.rewarded.index', compact('rewards'));
    }
}
