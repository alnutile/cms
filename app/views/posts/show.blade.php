@extends('layouts.main')

@section('content')

@if($settings->enable_left_nav)
<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
    <div class = "sidebar-nav">
		<div class="mobile-menu light-theme"><a href="#"><i class="fa fa-bars"></i></a></div>
        @include('shared.sidebar')
        @if(Auth::user())
        <div class="well">
            Edit this page <br>
            <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>
        </div>
        @endif
    </div>
</div>
@endif

@if($settings->enable_left_nav)
<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 column">
@else
<div class="col-md-12 col-sm-7 col-md-8 col-lg-12 column">
@endif
	
    <h1>{{ $post->title }}</h1>	
    <p> {{ $post->intro }} </p>
   @if ($post->image && $post->created_at < '2018-09-01 00:00:00')
	   <div class="row">        
			<div class = "col-lg-12" id="main_image">
				@if(file_exists(public_path().'/img/posts/full/'.$post->image))
					<img  src="/img/posts/full/{{$post->image}}" alt="{{$post->title}}" class="img-responsive">	
				@else
					<img  src="/img/posts/{{$post->image}}" alt="{{$post->title}}" class="img-responsive">
				@endif			
			</div>        
		</div>
   @endif
   <p> {{ $post->body }} </p>

    @if(isset($post->images[0]))
		@if($settings->theme != true)
		<div class="help-block" >
			Click on images below to enlarge.
		</div>
		@endif
    
    @endif



</div>

@stop
