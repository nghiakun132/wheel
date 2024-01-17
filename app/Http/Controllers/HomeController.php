<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reward;
use Illuminate\Http\Request;

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

        foreach ($rewards as $key => $value) {
            $value->background = $backgrounds[$value->id];
        }
      
        return view('index', compact('questions', 'rewards'));
    }
}
