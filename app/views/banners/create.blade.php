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

                <label for="email">Reference Name</label>
                {{ Form::text('name', null, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('name'))
                <div class="alert alert-danger">
                    {{  $errors->first('name'); }}
                </div>
                @endif
        </div>
        <div class="form-group">
          <label for="email">Upload File</label>
          <div class="help-block">Banner images must be at least 1600px wide by 196px high.  Aspect ratio should be roughly 8:1.</div>
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