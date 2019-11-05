@extends('layouts.main')

@section('content')
<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
    <div class = "sidebar-nav">
    	<div class="mobile-menu"><a href="#"><i class="fa fa-bars"></i></a></div>
		@include('shared.sidebar')
		@if(Auth::user())
        <div class="well">
            Create New Project <br>
            <a href="/projects/create" class="btn btn-success">Create</a>
        </div>
        @endif
    </div>
</div>
<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 column content blog_index">
    <div class="portfolio-wrap">
        @foreach($projects as $p)
        <div class="col-xs-3 col-md-4 project_block">
            <a href="/projects/{{$p->id}}/edit">

                <div class="proj_img">
				
				@if($p->thumbs->url() && file_exists(public_path($p->thumbs->url())) )                    
                    <img class="col-md-6 img-thumbnail" src="<?= $p->thumbs->url('project_top')?>" alt="{{$p->title}}" class="img-responsive">
				@elseif ($p->image)
					<img id="project-top-image" src="/img/projects/{{$p->image}}" alt="{{$p->title}}">                
                @endif  
					
                </div>
            <div class="project_grid_title">{{$p->title}}</div></a>
        </div>
        @endforeach		
    </div>
</div>
@stop
