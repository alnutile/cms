@extends('layouts.main')

@section('content')

<div class="container login">
    <div class="row">
        <div class="center col-md-4 well">
            <legend><i class="glyphicon-cog glyphicon"></i> Edit Profile</legend>
            <strong>Update your info below eg password, email etc</strong>
            <hr>
                @include('sessions.notice')
            {{ Form::open(array('action' => 'UsersController@update', 'method' => 'put')) }}
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <fieldset>
                <div class="form-group">
                    <small>
                        <label for="email">Email</label>
                        {{ Form::text('email', $user->email, array('class' => 'form-control', 'tabindex' => 1)) }}
                        @if($errors->first('email'))
                        <div class="alert alert-danger">
                            {{  $errors->first('email'); }}
                        </div>
                        @endif
                </div>
                <div class="form-group">
                    <label for="password">
                        <small>
                            <label for="password">Password</label>
                        </small>
                    </label>
                    {{ Form::password('password', array('class' => 'form-control', 'tabindex' => 2)) }}
                    @if($errors->first('password'))
                        <div class="alert alert-danger">
                            {{  $errors->first('password'); }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation">
                        <small>
                            <label for="password_confirmation">Password Confirmation</label>
                        </small>
                    </label>
                    {{ Form::password('password_confirmation', array('class' => 'form-control', 'tabindex' => 2)) }}
                    @if($errors->first('password_confirmation'))
                    <div class="alert alert-danger">
                        {{  $errors->first('password_confirmation'); }}
                    </div>
                    @endif
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