@extends('layouts.main')
<?php if($portfolio_category){ $seo = $portfolio_category->desc;}?>
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
	@if($portfolio_category) 
		<h1>{{$portfolio_category->name}}</h1>
		<p>{{$portfolio_category->body}}</p>
	@endif
    <div class="portfolio-wrap">
        @foreach($projects as $p)
        <div class="col-xs-3 col-md-4 project_block">
            <a href="{{$p->slug}}">

                <div class="proj_img">
				@if ($p->tile_image)
					@if(file_exists(public_path().'/img/projects/tile/'.$p->tile_image))
						<img src="/img/projects/tile/{{$p->tile_image}}" alt="{{$p->title}}" class="img-responsive">
					@else
						<img src="/img/projects/{{$p->tile_image}}" alt="{{$p->title}}" class="img-responsive">
					@endif
				@else
				<img  src="/img/default/photo_default_0.png" alt="{{$p->title}}" class="img-responsive">
				@endif
				</div>
            <div class="project_grid_title">{{$p->title}}</div></a>
        </div>
        @endforeach		
    </div>
</div>
@stop
