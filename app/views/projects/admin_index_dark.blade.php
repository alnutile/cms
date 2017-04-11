@extends('layouts.main')

@section('content')

<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
    <div class="sidebar-nav">
		@include('shared.sidebar')
	</div>
</div>

<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 column content">
    <h3>Manage Projects</h3>
    <hr>
    <table class="table table-hover table-striped table-condensed dark-table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Sort</th>
            <th>Published</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td><a href="/projects/{{$project->id}}">{{{$project->title}}}</a></td>

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