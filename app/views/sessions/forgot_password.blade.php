@extends('layouts.main')

@section('content')

<div class="container login">
    <div class="row">
        <div class="center col-md-4 well">
            @include('sessions.notice')
            <form method="POST" action="{{ (Confide::checkAction('UserController@do_forgot_password')) ?: URL::to('/user/forgot') }}" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

                <div class="form-group">
                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>
                    <div class="input-append input-group">
                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                        <span class="input-group-btn">
                            <input class="btn btn-default" type="submit" value="{{{ Lang::get('confide::confide.forgot.submit') }}}">
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop