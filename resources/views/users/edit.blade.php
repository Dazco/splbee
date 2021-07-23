@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>

    {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('school', 'School*', ['class' => 'control-label']) !!}
                    <select class="form-control"
                            name="school">
                        <option selected>Choose School...</option>
                        @if(isset($schools) && count($schools))
                            @foreach($schools as $school)
                                <option value="{{$school->id}}" {{$school->id == old('school', $user->school->id)? 'selected':''}} >{{strtoupper($school->name)}}</option>
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
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('age', 'Age*', ['class' => 'control-label']) !!}
                    <select class="form-control"
                            name="age">
                        <option>Choose age...</option>
                        @for($i=7;$i<=17;$i++)
                            <option value="{{$i}}" {{$i == old('age', $user->age) ? 'selected':''}}>{{$i}}years
                            </option>
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
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('role_id', 'Role*', ['class' => 'control-label']) !!}
                    {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('role_id'))
                        <p class="help-block">
                            {{ $errors->first('role_id') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

