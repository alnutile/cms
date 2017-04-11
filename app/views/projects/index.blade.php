@extends('layouts.main')

@section('content')
<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
    <div class="sidebar-nav">
		@include('shared.sidebar')
	</div>
</div>
<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 column content">
    <h4>Projects</h4>
    <ul class="list-unstyled">
        @foreach($projects as $project)
            <li>
                {{$project->title}}
                <a id="project-id-{{$project->id}}" href="{{$project->slug}}">
                    view
                </a>
            </li>
        @endforeach
    </ul>
</div>
@stop