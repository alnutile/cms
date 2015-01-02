@extends('layouts.main')

@section('content')
<!-- pages.show -->
<div class="col-md-3 col-xs-5">
    @include('shared.sidebar')

    @if(Auth::user())
    <div class="well">
        Edit this page <br>
        <a href="/pages/{{$page->id}}/edit" class="btn btn-success">Edit</a>
    </div>
    @endif
</div>

<div class="col-md-9 col-xs-7 column">
    @if($page->id != 1 || $settings->theme == false)

    <h1>{{{ $page->title }}}</h1>
    <p> {{ $page->body }} </p>

    @if($page->id == 4)
    @foreach($projects as $project)
    @include('shared.projects_teasers')
    @endforeach
    {{ $projects->links() }}
    @endif

@endif
</div>


@stop