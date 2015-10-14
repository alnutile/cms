@extends('layouts.main')

@section('content')
<div class="col-md-3">
    <div class = "sidebar-nav">
        @include('shared.sidebar')
        @if(Auth::user())
        <div class="well">
            Edit this page <br>
            <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>
        </div>
        @endif
    </div>
</div>

<div class="col-md-9 column">
    <h1>{{{ $post->title }}}</h1>
    <p> {{ $post->intro }} </p>
    <div class="row">
        @if ($post->image)
        <div class = "col-lg-12" id="main_image">
            <img  src="/img/posts/{{$post->image}}" alt="{{$post->title}}">
        </div>
        @endif
    </div>
    <p> {{ $post->body }} </p>

    @if(isset($post->images[0]))
    @if($settings->theme != true)
    <div class="help-block">
        Click on images below to enlarge.
    </div>
    @endif
    <div class = "gallery_row">

        @foreach ($post->images as $image)
        @if($settings->theme == false)
        <div class = "col-lg-6 gallery_item">
            <a class="gallery" href="/assets/img/posts/{{$image->file_name}}" alt="{{$image->file_name}}" title="{{$image->image_caption}}">
                <img class="col-lg-12" src="/assets/img/posts/{{$image->file_name}}" alt="{{$image->file_name}}">
            </a>
        </div>
        @else
        <div class = "col-lg-12 gallery_item_dark">
            <img src="/assets/img/posts/{{$image->file_name}}" alt="{{$image->file_name}}">
            @endif
            <br>
            <span class="caption">{{$image->image_caption}}</span>
        </div>
        @endforeach
    </div>
    @endif



</div>

@stop