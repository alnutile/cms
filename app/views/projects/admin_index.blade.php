@extends('layouts.main')

@section('content')

<div class="col-md-3">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column content">
    <h3>Manage Projects</h3>
    <hr>
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>Title</th>
            <th>Related Portfolio</th>
            <th>Sort</th>
            <th>Published</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td><a href="/projects/{{$project->id}}">{{$project->title}}</a></td>
                    <td><a href="{{$project->portfolio->slug}}">{{$project->portfolio->title}}</a></td>
                    <td>{{$project->order}}</td>
                    <td>{{$project->published}}</td>
                    <td>
                        <a id="project-id-{{$project->id}}"
                           href="/projects/{{$project->id}}/edit">
                            edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="/projects/create">create project</a>
</div>
@stop