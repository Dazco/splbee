@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center" style="color: white">SpellingBee</h1>
            {{--            <h3 class="text-center" style="color: white">How well do you know Laravel?</h3>--}}
            <br/>
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were problems with input:
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">School</label>

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
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Age</label>

                            <div class="col-md-6">
                                <select class="form-control"
                                        name="age">
                                    <option selected>Choose age...</option>
                                    @for($i=7;$i<=17;$i++)
                                        <option value="{{$i}}">{{$i}} years</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!--                        <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="remember">Remember me
                                                        </label>
                                                    </div>
                                                </div>-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit"
                                        class="btn btn-primary">
                                    Login
                                </button>
                                <a href="{{ route('auth.register') }}"
                                   class="btn btn-default">
                                    Register
                                </a>
                                <br>
                                {{--                                <a href="{{ route('auth.password.reset') }}">Forgot password</a>--}}
                                <br>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
