@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">

        {{ Form::model($page, array('method' => 'PUT', 'route' => array('pages.update', $page->id), 'role' => 'form')) }}


        <div class="form-group">
            <label>Title</label>
            {{ Form::text('title', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            <label>Body</label>
            {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
        </div>

        <div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('active') }}Active</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>URL</label>
            {{ Form::text('slug', null, array('class' => 'form-control')) }}
        </div>

        <div class="controls">
            {{ Form::submit('Update Page', array('class' => 'btn btn-success')) }}
            <br>
        </div>

        {{ Form::close() }}

        {{ Form::open(['method' => 'DELETE', 'action' => ['PagesController@destroy', $page->id]]) }}
        <button type="submit" class="btn btn-danger">Delete</button>
        {{ Form::close() }}
</div>


@stop