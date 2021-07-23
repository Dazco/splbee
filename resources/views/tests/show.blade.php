@extends('layouts.app')

@section('content')
    @if($topic)
        <h3 class="page-title">{{strtoupper($topic->title)}}
            <span id="timer" data-time="{{$topic->timer}}" class="text-success"
                  style="float:right; font-weight: bold;">{{$topic->timer}}</span>
        </h3>
    @endif
    {!! Form::open(['method' => 'POST', 'route' => ['tests.submit']]) !!}
    {!! Form::hidden('test_id', $test->id) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @if($topic->timer_level == 'topic')
                You have {{(new \Carbon\Carbon($topic->timer))->minute}} minutes for this quiz
            @else
                You have {{$topic->timer}} seconds for each question
            @endif
        </div>
        <?php //dd($questions) ?>
        @if(count($questions) > 0)
            <div class="panel-body">
                <?php $i = 1; ?>
                @foreach($questions as $question)
                    <div class="row question" id="question-{{$i}}">
                        <div class="col-xs-12 form-group">
                            <div class="form-group">
                                <strong>Question {{ $i }}.<br/>{!! nl2br($question->question_text) !!}</strong>

                                @if ($question->code_snippet != '')
                                    <div class="code_snippet">{!! $question->code_snippet !!}</div>
                                @endif

                                <input
                                        type="hidden"
                                        name="questions[{{ $i }}]"
                                        value="{{ $question->id }}">
                                @foreach($question->options as $option)
                                    <br>
                                    <label class="radio-inline">
                                        <input
                                                type="radio"
                                                name="answers[{{ $question->id }}]"
                                                value="{{ $option->id }}">
                                        {{ $option->option }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
        @endif
    </div>

    <button id="next-btn" class="btn btn-success">Next</button>
    {!! Form::submit('Finish Attempt', ['id' => 'submit-btn','class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/lib') }}/easytimer/dist/easytimer.min.js"></script>
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>

    <script>
        $('.question').hide();
        $('#submit-btn').hide();
        const time = {{$topic->timer}};
        const questionsCount = {{$topic->questions->count()}};
        let i = 1

        $('#question-' + i).show()

        let timer = new easytimer.Timer(/* default config */);
        timer.start({countdown: true, startValues: {seconds: time}, precision: 'seconds'});
        timer.addEventListener("secondsUpdated", function (e) {
            $("#timer").html(timer.getTimeValues().toString());
        });
        timer.addEventListener('targetAchieved', function (e) {
            nextQuestion(true);
        });

        $('#next-btn').on('click', function (e){
            e.preventDefault();
            nextQuestion();
        });

        const nextQuestion = (submit = false) => {
            console.log(i, questionsCount)
            $('#timer').html('-');
            $('#question-' + i).hide()
            if (i < questionsCount){
                i++;
                $('#question-' + i).show();
                timer.reset();
            }else{
                if(submit){
                    $('#submit-btn').click();
                }
            }

            if(i == questionsCount){
                $('#next-btn').hide();
                $('#submit-btn').show();
            }
        };
    </script>

@stop
