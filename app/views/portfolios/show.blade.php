@extends('layouts.main')

@section('content')
@if($settings->enable_left_nav)
<div class="col-md-3 ">
    @include('shared.sidebar')

    @if(Auth::user())


  <div class="well">
        Edit this page <br>
        <a href="/portfolios/{{$portfolio->id}}/edit" class="btn btn-success">Edit</a>
    </div>
    @endif
</div>
@endif

@if($settings->enable_left_nav)
<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 column">
@else
<div class="col-md-12 column">
@endif
    <h1>{{{ $portfolio->header }}}</h1>
    <p> {{ $portfolio->body }} </p>
    <hr>
    @if($portfolio->projects->count())
    <h3>Related Projects</h3>
    @endif

    @foreach($portfolio->projects as $project)
      @include('shared.projects_teasers')
    @endforeach

</div>


@stop