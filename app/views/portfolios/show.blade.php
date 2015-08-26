@extends('layouts.main')

@section('content')
<div class="col-md-3 ">
    @include('shared.sidebar')

    @if(Auth::user())


  <div class="well">
        Edit this page <br>
        <a href="/portfolios/{{$portfolio->id}}/edit" class="btn btn-success">Edit</a>
    </div>
    @endif
</div>

<div class="col-md-9 column">
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