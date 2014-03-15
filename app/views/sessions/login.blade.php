@extends('layouts.main')

@section('content')

<div class="container login">
    <div class="row">
        <div class="center col-md-4 well">
            <legend>Please Sign In</legend>
            @include('sessions.notice')
            {{ Form::open(array('action' => 'UsersController@authenticate', 'method' => 'put')) }}
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <fieldset>
                    <div class="form-group">
                        <small>
                            <label for="email">Email</label>
                        {{ Form::text('email', null, array('class' => 'form-control', 'tabindex' => 1)) }}
                    </div>
                    <div class="form-group">
                        <label for="password">
                            <small>
                                <label for="password">Password</label>
                            </small>
                        </label>
                        {{ Form::password('password', array('class' => 'form-control', 'tabindex' => 2)) }}
                    </div>

                    <div class="form-group">
                        {{ Form::submit('Login', array('class' => 'btn btn-success')) }}
                    </div>
                </fieldset>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop