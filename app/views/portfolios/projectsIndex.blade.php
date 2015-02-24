@extends('layouts.main')

@section('content')
<div class="col-md-3">
    <div class = "sidebar-nav">
        @include('shared.sidebar')
        @if(Auth::user())
        <div class="well">
            Create New Project <br>
            <a href="/projects/create" class="btn btn-success">Create</a>
        </div>
        @endif
    </div>
</div>
<div class="col-md-9 column content blog_index">
    <div class = "">
        @foreach($projects as $p)
        <div class="col-md-4 project_block">
            <a href="/projects/{{$p->id}}">

                <div class="proj_img">
                    @if ($p->image)
                    <img  src="/img/projects/{{$p->tile_image}}" alt="{{$p->title}}" class="img-responsive">
                    @else
                    <img  src="/img/default/photo_default_0.png" alt="{{$p->title}}" class="img-responsive">
                    @endif
                </div>
            </a>
            <div class="project_grid_title">{{$p->title}}</div>
        </div>
        @endforeach
    </div>
</div>
@stop