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
    <img class="col-lg-12" src="/img/projects/{{$project->image}}" alt="{{$project->title}}">
  </div>
  <div class="row">
    {{$project->body}}
  </div>
  @foreach ($project->images as $image)

  <a class="gallery" href="/assets/img/projects/{{$image->file_name}}" alt="{{$image->file_name}}"><img class="col-lg-3" src="/assets/img/projects/{{$image->file_name}}" alt="{{$image->file_name}}"></a>

  @endforeach
</div>


</div>


@stop