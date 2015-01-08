@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content blog_index">
    <div class = "">
        @foreach($posts as $p)
        <div class="row blog_row">
            <a href="/posts/{{$p->id}}">

                <div class="post_intro col-md-9">
                    <h2 class="media-heading">{{{$p->title}}}</h2>{{$p->id}}
                    {{ $p->intro }}
                </div>

                <div class="post_img col-md-3">
                    @if ($p->image)
                    <img  src="/img/posts/thumb/{{$p->image}}" alt="{{$p->title}}" class="img-responsive">
                    @else
                    <img  src="/img/default/photo_default_0.png" alt="{{$p->title}}" class="img-responsive">
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop