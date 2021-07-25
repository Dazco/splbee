@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to the International SpellingBee Dubai Qualifiers</div>

                <style>
                    li{
                        margin-bottom: 15px;
                    }
                </style>
                <div class="panel-body">
                    <h2 style="font-weight: bold;">Instructions</h2>
                    <p style="font-size: 18px;">Please carefully read the instructions on this page before attempting to take the test.</p>
                    <ul style="list-style: decimal; font-size: 16px; word-spacing: 5px;">
                        <li>30 questions for the senior category (Ages 12 - 17)</li>
                        <li>20 questions for the junior category (Ages 7 - 11)</li>
                        <li>Please write the test that is corresponding to your age.</li>
                        <li>You have 20secs alloted time to attempt each question, the page automatically closes after
                            20secs for Spellers to attempt the next question.
                        </li>
                        <li>You cannot go back to the previous question.</li>
                        <li>Your score will pop up at the end of all the questions.</li>
                        <li>A pop up message informing you of your performance will come up after the score</li>
                        <li>The message will read that you qualify to travel to Dubai or you do not qualify for the
                            Dubai competition.
                        </li>

                    </ul>
                </div>
            </div>
            <a href="{{ route('tests.index') }}" class="btn btn-success">Take a new quiz!</a>
        </div>
    </div>
@endsection
