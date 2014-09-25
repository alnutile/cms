@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
            <legend><i class="glyphicon-cog glyphicon"></i> Create Profile</legend>
            <strong>Create user eg password, email etc</strong>
            <hr>
            @include('sessions.notice')
            {{ Form::model('user', array('route' => array('users.store'), 'role' => 'form')) }}
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <fieldset>
                <div class="form-group">
                        <label for="email">First Name</label>
                        {{ Form::text('firstname', $user->firstname, array('class' => 'form-control', 'tabindex' => 1)) }}
                        @if($errors->first('email'))
                        <div class="alert alert-danger">
                            {{  $errors->first('firstname'); }}
                        </div>
                        @endif
                </div>
                <div class="form-group">

                        <label for="email">Last Name</label>
                        {{ Form::text('lastname', $user->lastname, array('class' => 'form-control', 'tabindex' => 1)) }}
                        @if($errors->first('lastname'))
                        <div class="alert alert-danger">
                            {{  $errors->first('lastname'); }}
                        </div>
                        @endif
                </div>
                <div class="form-group">

                        <label for="email">Email (<a href="http://www.restorationtrades.com/help.html#profile_email">Help</a>)</label>
                        {{ Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'tabindex' => 3)) }}
                        @if($errors->first('email'))
                        <div class="alert alert-danger">
                            {{  $errors->first('email'); }}
                        </div>
                        @endif
                </div>

                <div class="form-group">
                    <label for="password">

                            <label for="password">Password (<a href="http://www.restorationtrades.com/help.html#profile_password">Help</a>)</label>

                    </label>
                    {{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'tabindex' => 3)) }}
                    @if($errors->first('password'))
                        <div class="alert alert-danger">
                            {{  $errors->first('password'); }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation">

                            <label for="password_confirmation">Password Confirmation (<a href="http://www.restorationtrades.com/help.html#profile_password_confirmation">Help</a>)</label>

                    </label>
                    {{ Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'tabindex' => 4)) }}
                    @if($errors->first('password_confirmation'))
                    <div class="alert alert-danger">
                        {{  $errors->first('password_confirmation'); }}
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::submit('Create', array('class' => 'btn btn-success')) }}
                </div>
            </fieldset>
            {{ Form::close() }}
</div>
@stop
