@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">

    <h2>Create Portfolio:</h2>

    {{ Form::model('portfolio', array('method' => 'POST', 'route' => array('portfolios.store'), 'role' => 'form')) }}


    <div class="form-group">
        <label>Title</label>
        {{ Form::text('title', null, array('class' => 'form-control')) }}
    </div>
    @if($errors->first('title'))
    <div class="alert alert-danger">
        {{  $errors->first('title'); }}
    </div>
    @endif

    <div class="form-group">
        <label>Body</label>
        {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
    </div>
    @if($errors->first('body'))
    <div class="alert alert-danger">
        {{  $errors->first('body'); }}
    </div>
    @endif

    @if(Auth::user()->admin == 1)
    <div class="form-group">
        <label>URL</label>
        {{ Form::text('slug', null, array('class' => 'form-control')) }}
        <div class="help-block">The url must start with / </div>
    </div>
    @if($errors->first('slug'))
    <div class="alert alert-danger">
        @if($errors->first('slug'))
        Please make sure your url starts with / and only contains alpha numeric characters and dashes.
        @endif
    </div>
    @endif
    @endif

    <div class="form-group">
        <div class="controls">
            <div class="checkbox">
                <label class="checkbox">{{ Form::checkbox('published', 1) }} Published</label>
            </div>
        </div>
    </div>

    <div class="controls">
        {{ Form::submit('Update Portfolio', array('id' => 'submit', 'class' => 'btn btn-success')) }}
        <br>
    </div>

    {{ Form::close() }}


</div>


@stop