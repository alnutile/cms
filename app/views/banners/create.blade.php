@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <legend><i class="glyphicon-cog glyphicon"></i> Create Banner</legend>
    <hr>
    @include('sessions.notice')
    {{ Form::model('banner', array('route' => array('banners.store'), 'files' => 'true', 'role' => 'form')) }}
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
        <div class="form-group">

                <label for="email">Banner Name (<a href="http://restorationtrades.com/help/admin_banners.html" target="_blank">Help</a>)</label>
                {{ Form::text('name', null, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('name'))
                <div class="alert alert-danger">
                    {{  $errors->first('name'); }}
                </div>
                @endif
        </div>
        <div class="form-group">
          <label for="email">Banner Image Uploader (<a href="http://restorationtrades.com/help/admin_banners.html" target="_blank">Help</a>)</label>
          <div class="help-block">The default banner images are 1600 x 379 pixels, in dimension. Other sizes will upload and display.</div>
          {{ Form::file('banner_name', null, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('banner_name'))
                <div class="alert alert-danger">
                    Banner Image Required
                </div>
                @endif
        </div>
        <div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('active', 1) }} Active</label>
                </div>
            </div>
        </div>

        <div class="form-group">

                <label for="email">Sort Order</label>&nbsp;
                {{ Form::selectRange('order', 1, 10, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('order'))
                <div class="alert alert-danger">
                    {{  $errors->first('order'); }}
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
