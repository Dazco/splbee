@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Spellingbee</div>
                    <div class="panel-body">
                        <div class="form-group text-center">

                            <a href="{{route('auth.register')}}" type="button" class="btn btn-lg btn-primary">
                                REGISTER
                            </a>
                            <a href="{{route('auth.login')}}" type="button" class="btn btn-lg btn-success">
                                TAKE THE TEST
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
