<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use DB;
use Exception;
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
        DB::beginTransaction();
        try {

            $quantity = $request->quantity;

            foreach ($quantity as $key => $value) {
                $reward = Reward::find($value['id']);

                if ($reward->reward_quantity != (int) $value['quantity']) {
                    $reward->reward_quantity = (int) $value['quantity'];
                    $reward->save();
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật thành công'
            ]);
        } catch (Exception $ex) {

            DB::rollBack();
            report($ex);
            
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function rewarded()
    {
        $date = request()->get('date');
        $rewards = Reward::where('shop_name', '<>', config('app.admin.name'));

        if (!$date) {
            $rewards = $rewards->withCount([
                'rewarded' => function ($query) use ($date) {
                    return $query->whereDate('created_at', $date);
                }
            ]);
        } else {
            $rewards = $rewards->withCount('rewarded');
        }

        $rewards = $rewards->get();
        $rewards = $rewards->groupBy('shop_name');

        return view('admin.rewarded.index', compact('rewards'));
    }
}
