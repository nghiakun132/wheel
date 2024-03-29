<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\RewardUser;
use App\Models\Survey;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function submit(Request $request)
    {
        \Log::info($request->all());
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->input('name', '');
            $user->phone = $request->input('phone', '');
            $user->email = $request->input('email', '');
            $user->shop_name = $request->input('shop_name', '');
            $user->age = $request->input('age', '');
            $user->sex = $request->input('sex', '');

            $user->save();

            $answer = $request->answer;

            foreach ($answer as $question => $ans) {
                $survey = new Survey();
                $survey->user_id = $user->id;
                $survey->question_id = $question;
                $survey->answer_id = $ans;
                $survey->save();
            }

            $reward = Reward::where('id', $request->reward)
                ->where('shop_name', $request->shop_name)
                ->first();

            $reward_user = new RewardUser();
            $reward_user->user_id = $user->id;
            $reward_user->reward_id = $reward->id;

            $reward_user->save();

            $reward->decrement('reward_quantity');

            DB::commit();

            return response()->json([
                'message' => 'success',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return response()->json([
                'message' => 'error',
            ]);
        }
    }
}
