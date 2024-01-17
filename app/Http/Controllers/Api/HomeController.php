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
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();

            $answer = $request->answer;

            foreach ($answer as $question => $ans) {
                $survey = new Survey();
                $survey->user_id = $user->id;
                $survey->question_id = $question;
                $survey->answer_id = $ans;
                $survey->save();
            }

            $reward = Reward::where('reward_name', $request->reward)->first();

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
            return response()->json([
                'message' => 'error',
            ]);
        }

    }
}
