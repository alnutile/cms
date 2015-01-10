@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')

    @if(Auth::user())

    <div class="well">
        Edit this page <br>

        <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>
    </div>
    @endif
</div>

<div class="col-md-9 column">
    <h1>{{{ $post->title }}}</h1>
    <p> {{ $post->intro }} </p>
    <p> {{ $post->body }} </p>
    @if(isset($post->images[0]))
    <br>
    <ul class="post_gallery">
        @foreach($post->images as $image)
        <li><img src="/assets/img/posts/{{$image->file_name}}"></li>
        @endforeach
    </ul>
    @endif

</div>

@stop