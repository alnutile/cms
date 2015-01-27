@extends('layouts.main')
<!--    index by blade-->
@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content blog_index">
    <div class = "">
        @foreach($projects as $p)
        <div class="row projects_row">
            <a href="/projects/{{$p->tagable_id}}">

                <div class="project_img col-md-3">
                    @if ($p->image)
                    <img  src="/img/projects/{{$p->image}}" alt="{{$p->title}}" class="img-responsive">
                    @else
                    <img  src="/img/default/photo_default_0.png" alt="{{$p->title}}" class="img-responsive">
                    @endif
                </div>
                <div class="project_img col-md-9">
                    {{$p->title}}
                    {{$p->body}}
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop