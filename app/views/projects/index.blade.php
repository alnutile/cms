@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
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