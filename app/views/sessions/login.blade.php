@extends('layouts.main')

@section('content')

<div class="container login">
    <div class="row">
		@if($settings->theme == true)
			<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
				<div class="sidebar-nav">
					<div class="mobile-menu"><a href="#"><i class="fa fa-bars"></i></a></div>
					@include('shared.sidebar')
				</div>
			</div>
			
			@endif
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9 well">
            <legend>Please Sign In</legend>
            @include('sessions.notice')
            {{ Form::open(array('action' => 'UsersController@authenticate', 'method' => 'put', 'class' => "col-md-7 col-lg-8 col-sm-12 col-xs-12")) }}
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <fieldset>
                    <div class="form-group">

                            <label for="email">Email</label>
                        {{ Form::text('email', null, array('class' => 'form-control', 'tabindex' => 1)) }}
                    </div>
                    <div class="form-group">
                        <label for="password">

                                <label for="password">Password</label>

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