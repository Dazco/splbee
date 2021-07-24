<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\TestAnswer;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $score = 0;
        $average = 0.00;
        $tests = Test::all();
        if (count($tests)) {
            foreach ($tests as $test) {
                $count = $test->answers()->count();

                if(!$count) continue;
                $score += $test->result / $count;
            }
            $average = ($score / count($tests)) * 100;
        }
        $questions = Question::count();
        $users = User::whereNull('role_id')->count();
        $quizzes = Test::count();
        return view('home', compact('questions', 'users', 'quizzes', 'average'));
    }
}
