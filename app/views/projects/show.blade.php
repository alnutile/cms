@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
  @include('shared.sidebar')



  @if(Auth::user())
  <div class="well">
    Edit this page <br>
    <a href="/projects/{{$project->id}}/edit" class="btn btn-success">Edit</a>
  </div>
  @endif
</div>

<div class="col-md-9 column">
  <h1>{{{ $project->title }}}</h1>
  <div class="row">
    @if ($project->image)
    <div class = "col-lg-12" id="main_image">
      <img  src="/img/projects/{{$project->image}}" alt="{{$project->title}}">
    </div>
    @endif
   </div>
  <div class="row">
    <div class="col-lg-12">
      {{{$project->city_county}}}
    <br>
      {{{$project->state_country}}}
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 body">
      {{$project->body}}
    </div>
  </div>
  @if($project->images)
      <div class="help-block">
        Click on images below to enlarge.
      </div>
  @endif
  <div class = "row gallery_row">

    @foreach ($project->images as $image)
    <div class = "col-lg-6 gallery_item">
      <a class="gallery" href="/assets/img/projects/{{$image->file_name}}" alt="{{$image->file_name}}" title="{{$image->image_caption}}"><img class="col-lg-12" src="/assets/img/projects/{{$image->file_name}}" alt="{{$image->file_name}}"></a>
      <br>
      <span class="caption">{{$image->image_caption}}</span>
    </div>
    @endforeach
  </div>
</div>


</div>


@stop