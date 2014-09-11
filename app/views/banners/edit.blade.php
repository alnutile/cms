@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <legend><i class="glyphicon-cog glyphicon"></i> Update Banner</legend>
    <hr>
    @include('sessions.notice')
    {{ Form::model($banner, array('method' => 'PUT', 'route' => array('banners.update', $banner->id), 'files' => 'true', 'role' => 'form')) }}
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
                    {{  $errors->first('banner_name'); }}
                </div>
                @endif
                <img src="{{$path}}/{{$banner->banner_name}}" class="banner-show">
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
                {{ Form::selectRange('order', 1, 10, $banner->order, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('banner_name'))
                <div class="alert alert-danger">
                    {{  $errors->first('banner_name'); }}
                </div>
                @endif
        </div>

        <div class="form-group">
            {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
          {{ Form::close() }}
        </div>
      <div>
        {{ Form::open(array('class' => 'inline', 'method' => 'DELETE', 'route' => array('banners.destroy', $banner->id))) }}
        {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete this?")')) }}
        {{ Form::close() }}
      </div>
    </fieldset>

</div>
@stop