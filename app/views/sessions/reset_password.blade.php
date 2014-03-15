@extends('layouts.main')

@section('content')
<div class="container login">
    <div class="row">
        <div class="center col-md-4 well">
            <form method="POST" action="{{{ (Confide::checkAction('UserController@do_reset_password'))    ?: URL::to('/user/reset') }}}" accept-charset="UTF-8">
                @include('sessions.notice')
                <input type="hidden" name="token" value="{{{ $token }}}">
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

                <div class="form-group">
                    <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
