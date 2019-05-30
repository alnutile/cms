@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">

    <h2>Edit Page: {{$page->title}}</h2>

        {{ Form::model($page, array('method' => 'PUT', 'route' => array('pages.update', $page->id), 'role' => 'form')) }}


        <div class="form-group">
            <label>Page Heading @if($settings->theme == true)
<a href="http://restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>
@endif

@if($settings->theme == false)
<a href="http://restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>
@endif</label>
            {{ Form::text('title', null, array('class' => 'form-control')) }}

        @if($errors->first('title'))
        <div class="alert alert-danger">
            {{  $errors->first('title'); }}
        </div>
        @endif

        <div class="form-group">
            <label>Page Browser Description (a.k.a. Title Tag) (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)</label>
            {{ Form::text('seo', null, array('class' => 'form-control')) }}
        </div>
        @if($errors->first('seo'))
        <div class="alert alert-danger">
            {{  $errors->first('seo'); }}
        </div>
        @endif

        <div class="form-group">
            <label>Page Main Body (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)</label>
            {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
        </div>
        @if($errors->first('body'))
        <div class="alert alert-danger">
            {{  $errors->first('body'); }}
        </div>
        @endif


        @if(Auth::user()->admin == 1)
            <div class="form-group">
                <label>Page Web Address (URL) (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)</label>
                {{ Form::text('slug', null, array('class' => 'form-control')) }}
                <div class="help-block">The url must start with / </div>
            </div>
            @if($errors->first('slug'))
            <div class="alert alert-danger">
                @if($errors->first('slug'))
              {{ $errors->first('slug') }}
                @endif
            </div>
            @endif
        @endif

        <div class="controls">
            {{ Form::submit('Update Page', array('id' => 'submit', 'class' => 'btn btn-success')) }}
            <br>
        </div>

        {{ Form::close() }}

        @if($page->id >= 5)
            {{ Form::open(['method' => 'DELETE', 'action' => ['PagesController@destroy', $page->id]]) }}
            <button type="submit" class="btn btn-danger">Delete</button>
            {{ Form::close() }}
        @endif
</div>


@stop
