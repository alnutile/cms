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
    <p> {{ $post->body }} </p>

</div>

@stop