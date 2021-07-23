@extends('layouts.app')

@section('content')
    @if($topic)
        <h3 class="page-title">{{strtoupper($topic->title)}} <small>{{$attempts}} attempt(s)</small></h3>
        {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}
        {!! Form::hidden('topic_id', $topic->id); !!}

        @if($attempts < $max_attempts)
        <div class="panel panel-default">
            <div class="panel-heading">
                Click to button below to take your quiz
            </div>

        </div>
            {!! Form::submit('Take Quiz', ['class' => 'btn btn-success']) !!}
        @else
            <div class="panel panel-default">
                <div class="panel-heading">
                    You've exceeded the maximum number of attempts allowed for this quiz
                </div>

            </div>
        @endif
        {!! Form::close() !!}
    @else
        <h3 class="page-title">No Quizzes scheduled for today</h3>
    @endif
@stop

@section('javascript')
@stop
