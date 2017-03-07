@extends('layouts.main')
<!--    index by blade-->
@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
    @if(Auth::user())
    <div class="well">
        Create New Project <br>
        <a href="/projects/create" class="btn btn-success">Create</a>
    </div>
    @endif
</div>
<div class="col-md-9 column content blog_index">
    <div class = "">
        @foreach($projects as $p)
        <div class="row projects_row">
            <a href="{{$p->slug}}">

                <div class="project_img col-md-3">
                    @if ($p->thumbs->url('index') != '/thumbs/index/missing.png')
                        <div class="col-lg-12 thumb" id="main_image">
                            <img src="<?= $p->thumbs->url('index') ?>">
                        </div>
                    @elseif ($p->image)
						@if(file_exists(public_path().'/img/projects/tile/'.$p->tile_image))
							<img src="/img/projects/tile/{{$p->tile_image}}" alt="{{$p->title}}" class="img-responsive">
						@else
							<img src="/img/projects/{{$p->tile_image}}" alt="{{$p->title}}" class="img-responsive">
						@endif
					@endif
                </div>
                <div class="project_img col-md-9">
                    {{$p->title}}
                    {{str_limit($p->body, $limit = 500)}}
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop