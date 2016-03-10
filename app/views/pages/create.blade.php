@extends('layouts.main')

@section('content')
<!-- pages.create -->

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <h2>Edit Page: {{$page->title or 'Default'}}</h2>
   
	{{ Form::model('pages', array('method' => 'POST', 'route' => array('pages.store'), 'files' => 'true', 'role' => 'form')) }}

    @if(($settings->theme == true) || $settings->theme == false)
    <div class="form-group">
        <label>Page Heading
            @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
        {{ Form::text('title', null, array('class' => 'form-control')) }}

        @if($errors->first('title'))
        <div class="alert alert-danger">
            {{  $errors->first('title'); }}
        </div>
        @endif
        @endif

        <div class="form-group">
            <label>Page Browser Description (a.k.a. Title Tag) 
            @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
            {{ Form::text('seo', null, array('class' => 'form-control')) }}
        </div>
        @if($errors->first('seo'))
        <div class="alert alert-danger">
            {{  $errors->first('seo'); }}
        </div>
        @endif
        @if(($settings->theme == true) || $settings->theme == false)
        <div class="form-group">
            <label>Page Main Body 
            @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
            {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
        </div>
        @if($errors->first('body'))
        <div class="alert alert-danger">
            {{  $errors->first('body'); }}
        </div>
        @endif
        @endif
        
		{{--
        @if($settings->theme = true)  // Removed $slideshow variable - $slideshow == true && 
        <!-- images upload -->
        <label>Project Blowup Images Uploader
        @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
        @include('shared.images_angular', array('model' => 'pages'))
        <br>
        <br>
        <!-- end images upload -->
        @endif
		--}}
		
        {{-- @if(Auth::user() && Auth::user()->admin == 1) --}}
        <div class="form-group">
            <label>Page Web Address (URL) 
			@if($settings->theme == true)
				(<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
            {{ Form::text('slug', null, array('class' => 'form-control')) }}
            <div class="help-block">The url must start with / </div>
        </div>
			@if($errors->first('slug'))
			<div class="alert alert-danger">
				@if($errors->first('slug'))
				{{ $errors->first('slug') }}
				@endif
			</div>
		<div class="form-group">
			@endif
       {{--  @endif  --}}
        {{-- Added checkbox for publish -JB 2-6-2016 --}}
		<div class="controls">
		  <div class="checkbox">
			<label class="checkbox">{{ Form::checkbox('published', 1) }} Published</label>
		  </div>
		</div>

        <div class="controls">
            {{ Form::submit('Update Page', array('id' => 'submit', 'class' => 'btn btn-success')) }}
            <br>
        </div>
        </div>
        {{ Form::close() }}
		{{--
        @if($pages->id >= 5)
        {{ Form::open(['method' => 'DELETE', 'action' => ['PagesController@destroy', $pages->id]]) }}
        <button type="submit" class="btn btn-danger">Delete</button>
        {{ Form::close() }}
        @endif
        --}}
    </div>
    @stop
