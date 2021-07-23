<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{


    /**
     * Display a new test.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $topics = Topic::where('status', 'pending')->whereDate('start_date', '<=', today())->get();
        return view('tests.index', compact('topics'));
    }

    public function start($id){
        $topic = Topic::findOrFail($id);
        $attempts = Test::where('user_id', auth()->user()->id)->count();
        $max_attempts = 10;
        return view('tests.create', compact('topic', 'attempts', 'max_attempts'));
    }

    public function show($id){
        $test = Test::where('user_id', auth()->id())->findOrFail($id);
        $topic = $test->topic;
        $questions = $topic->questions()->inRandomOrder()->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        /*
        foreach ($topics as $topic) {
            if ($topic->questions->count()) {
                $questions[$topic->id]['topic'] = $topic->title;
                $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
                shuffle($questions[$topic->id]['questions']['options']);
            }
        }
        */

        return view('tests.show', compact('topic', 'questions', 'test'));


    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $topic = Topic::findOrFail($request->input('topic_id'));
        $result = 0;
        $max_attempts = 10;
        if(Test::where('user_id', auth()->user()->id)->where('topic_id', $topic->id)->count() >= $max_attempts){
            return redirect()->back()->with([
                'message' => 'maximum attempts exceeded'
            ]);
        }
        $test = Test::create([
            'user_id' => Auth::id(),
            'topic_id' => $topic->id,
            'result'  => $result,
        ]);
        return redirect()->route('tests.show', $test->id);
    }

    public function submit(Request $request){
        $result = 0;

        $test = Test::findOrFail($request->input('test_id'));

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if ($request->input('answers.'.$question) != null
                && QuestionsOption::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test->id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.'.$question),
                'correct'     => $status,
            ]);
        }

        $test->update([
            'result' => $result,
            'status' => 'completed'
        ]);

        return redirect()->route('results.show', [$test->id]);
    }
}
