@extends('layouts.main')

@section('content')

<!-- posts.edit -->
<div class="col-md-3 ">
  @include('shared.sidebar')
</div>
<div class="col-md-9 column">

    <h2>Edit Blog Post: {{$post->title}}</h2>

    {{ Form::model($post, array('method' => 'PUT', 'route' => array('blog.update', $post->id), 'files' => 'true', 'role' => 'form')) }}


    <div class="form-group">
        <label>Blog Post Name (<a href="http://corbettresearchgroupinc.com/blog" target="_blank">Help</a>)</label>
        {{ Form::text('title', null, array('class' => 'form-control')) }}
    </div>
    @if($errors->first('title'))
    <div class="alert alert-danger">
        {{  $errors->first('title'); }}
    </div>
    @endif

    <div class="form-group">
        <label>Post Browser Description (a.k.a. Title Tag) (<a href="http://corbettresearchgroupinc.com/blog" target="_blank">Help</a>)</label>
        {{ Form::text('seo', null, array('class' => 'form-control')) }}
    </div>
    @if($errors->first('seo'))
    <div class="alert alert-danger">
        {{  $errors->first('seo'); }}
    </div>
    @endif

    <div class="form-group">
        <label>Intro Paragraph (<a href="http://corbettresearchgroupinc.com/blog" target="_blank">Help</a>)</label>
        {{ Form::textarea('intro', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
    </div>
    @if($errors->first('intro'))
    <div class="alert alert-danger">
        {{  $errors->first('intro'); }}
    </div>
    @endif

    <div class="form-group">
        <label>Blog Post Main Body (<a href="http://corbettresearchgroupinc.com/blog" target="_blank">Help</a>)</label>
        {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
    </div>
    @if($errors->first('body'))
    <div class="alert alert-danger">
        {{  $errors->first('body'); }}
    </div>
    @endif


    @include('shared.tags', array('model' => 'secondary_posts'))

    @if(Auth::user() && Auth::user()->admin == 1)
    <div class="form-group">
        <label>Blog Post Web Address (URL) (<a href="http://corbettresearchgroupinc.com/blog" target="_blank">Help</a>)</label>
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

    <!--   default images-->
    <div class="form-group">
        <label for="email">Default Image Uploader (<a href="http://corbettresearchgroupinc.com/blog" target="_blank">Help</a>)</label>
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
        <div class="help-block">This is the image we will use for the default Blog image</div>
    </div>
<!--end default images-->

   
    <!-- end images upload -->


    <div class="controls row">
        <div class="col-lg-2">
            {{ Form::submit('Update Blog Post', array('id' => 'submit', 'class' => 'btn btn-success')) }}
            {{ Form::close() }}
        </div>
        <div class="col-lg-2">
            {{ Form::open(['method' => 'DELETE', 'action' => ['BlogController@destroy', $post->id]]) }}
            {{ Form::submit('Delete', array('class' => 'btn btn-danger delete')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>


@stop
