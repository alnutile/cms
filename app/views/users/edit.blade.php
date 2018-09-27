@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
            <legend><i class="glyphicon-cog glyphicon"></i> Edit Profile</legend>
            <strong>Update your info below (e.g., password, email, etc.)</strong>
            <hr>
                @include('sessions.notice')
            {{ Form::model($user, array('method' => 'PUT', 'route' => array('users.update', $user->id), 'role' => 'form')) }}
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
                @if(Auth::user()->admin == 1 || $user->id == Auth::user()->id)
                <div class="form-group">
                        <label for="email">Email (<a href="http://corbettresearchgroupinc.com/profile" target="_blank">Help</a>)</label>
                        {{ Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'tabindex' => 3)) }}
                        @if($errors->first('email'))
                        <div class="alert alert-danger">
                            {{  $errors->first('email'); }}
                        </div>
                        @endif
                </div>
                @endif

                @if(Auth::user()->admin == 1 || $user->id == Auth::user()->id)
                <div class="form-group">
                    <div class="controls">
                        <div class="checkbox">
                            <label class="checkbox">{{ Form::checkbox('reset', null) }} Reset Password</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">
                            <label for="password">Password (<a href="http://corbettresearchgroupinc.com/profile" target="_blank">Help</a>)</label>
                    </label>
                    {{ Form::password('password', array('class' => 'form-control', 'tabindex' => 3)) }}
                    @if($errors->first('password'))
                        <div class="alert alert-danger">
                            {{  $errors->first('password'); }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation">
                            <label for="password_confirmation">Password Confirmation (<a href="http://corbettresearchgroupinc.com/profile" target="_blank">Help</a>)</label>
                    </label>
                    {{ Form::password('password_confirmation', array('class' => 'form-control', 'tabindex' => 4)) }}
                    @if($errors->first('password_confirmation'))
                    <div class="alert alert-danger">
                        {{  $errors->first('password_confirmation'); }}
                    </div>
                    @endif
                </div>
                @endif

                <div class="form-group">
                    {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
                </div>
            </fieldset>
            {{ Form::close() }}

            @if(Auth::user()->admin == 1 && $user->id != 1)
                {{ Form::open(['method' => 'DELETE', 'action' => ['UsersController@destroy', $user->id]]) }}
                <button type="submit" class="btn btn-danger delete">Delete</button>
                {{ Form::close() }}
            @endif
</div>
@stop
