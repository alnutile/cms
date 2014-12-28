@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
    <h2>Blog Posts</h2>

    @foreach($posts as $p)
    <div class="media">
        <div class="media-body">
            <h4 class="media-heading">{{{$p->title}}}</h4>
            <p>{{$p->body}}</p>
            <br>
            <a id="portfolio-id-{{$p->id}}"
               href="/posts/{{$p->id}}">view all blog posts</a>
        </div>
    </div>
    @endforeach

</div>
@stop