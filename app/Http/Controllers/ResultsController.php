<?php

namespace App\Http\Controllers;

use Auth;
use App\Test;
use App\TestAnswer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'show');
    }

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Test::all()->load('user');

        if (!Auth::user()->isAdmin()) {
            $results = $results->where('user_id', '=', Auth::id());
        }

        return view('results.index', compact('results'));
    }

    /**
     * Display Result.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id)->load('user');
        $pass_score = 80;

        if ($test) {
            $results = TestAnswer::where('test_id', $id)
                ->with('question')
                ->with('question.options')
                ->get();
        }
        $count = $results->count();
        if ($count > 0 && (($test->result / $count) * 100) >= $pass_score) {
            session()->flash('message', "Congratulations!!! <br> You have qualified to compete at the Intercontinental Spelling Bee taking place at the Springdales School, Dubai UAE from 22nd - 27th September, 2021. <br>Further details will be communicated with you.");
        } else {
            session()->flash('error', "Oops!!! <br> You have failed to qualify for the ICSB in Dubai 2021. <br> You stand a good chance next season, so register to participate in the qualifying Spelling Bee competition across the nation starting from October 2021 if you are still within the competition age of 17 years old.");
        }

        return view('results.show', compact('test', 'results'));
    }
}
