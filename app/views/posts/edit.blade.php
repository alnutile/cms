@extends('layouts.main')

@section('content')


<div class="col-md-9 column">

  <h2>Edit Blog Post: {{$post->title}}</h2>

  {{ Form::model($post, array('method' => 'PUT', 'route' => array('posts.update', $post->id), 'files' => 'true', 'role' => 'form')) }}


  <div class="form-group">
    <label>Blog Post Name (<a href="http://www.restorationtrades.com/help.html#portolio_name" target="_blank">Help</a>)</label>
    {{ Form::text('title', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('title'))
  <div class="alert alert-danger">
    {{  $errors->first('title'); }}
  </div>
  @endif


  <div class="form-group">
    <label>Blog Post Main Body (<a href="http://www.restorationtrades.com/help.html#Blog Post_page_description" target="_blank">Help</a>)</label>
    {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
  </div>
  @if($errors->first('body'))
  <div class="alert alert-danger">
    {{  $errors->first('body'); }}
  </div>
  @endif

    <div class="form-group">
        <label>Tags (<a href="http://www.restorationtrades.com/help.html#tags" target="_blank">Help</a>)</label>
        {{ Form::text('tags', null, array('class' => 'form-control')) }}
    </div>
    @if($errors->first('tags'))
    <div class="alert alert-danger">
        {{  $errors->first('tags'); }}
    </div>
    @endif

  @if(Auth::user()->admin == 1)
  <div class="form-group">
    <label>Blog Post Web Address (URL) (<a href="http://www.restorationtrades.com/help.html#Blog Post_web_address" target="_blank">Help</a>)</label>
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

  <div class="form-group">
    <div class="controls">
      <div class="checkbox">
        <label class="checkbox">{{ Form::checkbox('published', 1) }} Published</label>
      </div>
    </div>
  </div>

<!--    images-->

    <div class="form-group">
        <label for="email">Project Default Image Uploader (<a href="http://www.restorationtrades.com/help.html#project_default_image_uploader" target="_blank">Help</a>)</label>
        {{ Form::file('image', null, array('class' => 'form-control', 'tabindex' => 1)) }}
        @if($errors->first('image'))
        <div class="alert alert-danger">
            {{  $errors->first('image'); }}
        </div>
        @endif
        @if($post->image)
        <div class="row">
            <div>
                <img  class="col-lg-4" src="/{{$path}}/{{$post->image}}" class="banner-show">
            </div>
        </div>
        @endif
        <div class="help-block">This is the image we will use for the default project image</div>
    </div>

    <br>
    <br>

    <!-- images upload -->
    <label>Project Blowup Images Uploader (<a href="http://www.restorationtrades.com/help.html#project_blowup_image_uploader" target="_blank">Help</a>)</label>
    @include('posts.images_angular')

    <br>
    <br>
    <!-- end images upload -->

  <div class="controls">
    {{ Form::submit('Update Blog Post', array('id' => 'submit', 'class' => 'btn btn-success')) }}
    <br>
  </div>

  {{ Form::close() }}
  {{ Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) }}
  <button type="submit" class="btn btn-danger">Delete</button>
  {{ Form::close() }}
</div>


@stop
