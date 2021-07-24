@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
                                <label for="school" class="col-md-4 control-label">School</label>

                                <div class="col-md-6">
                                    <select class="form-control"
                                            name="school">
                                        <option selected>Choose School...</option>
                                        @if(isset($schools) && count($schools))
                                            @foreach($schools as $school)
                                                <option value="{{$school->id}}">{{strtoupper($school->name)}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"></p>
                                    @if($errors->has('school'))
                                        <p class="help-block">
                                            {{ $errors->first('school') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Full Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">Age</label>

                                <div class="col-md-6">
                                    <select class="form-control"
                                            name="age">
                                        <option selected>Choose age...</option>
                                        @for($i=7;$i<=17;$i++)
                                            <option value="{{$i}}">{{$i}} years</option>
                                        @endfor
                                    </select>
                                    <p class="help-block"></p>
                                    @if($errors->has('age'))
                                        <p class="help-block">
                                            {{ $errors->first('age') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
