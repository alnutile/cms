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
    </div>


</div>


@stop