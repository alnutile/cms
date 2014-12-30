@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
    <h2>Blog Posts</h2>
    <div class = "row">
        @foreach($posts as $p)
        <div class="col-md-4">
            <a href="/posts/{{$p->id}}" class="">
                @if ($p->image)
                <img  src="/img/posts/thumb/{{$p->image}}" alt="{{$p->title}}" class="img-responsive">
                @else
                <img  src="/img/default/photo_default_0.png" alt="{{$p->title}}" class="img-responsive">
                @endif
                <h4 class="media-heading">{{{$p->title}}}</h4>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop