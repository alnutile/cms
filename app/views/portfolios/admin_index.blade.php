@extends('layouts.main')

@section('content')
<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
	<div class="sidebar-nav">
		@include('shared.sidebar')
	</div>
</div>

<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content column">
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>Title</th>
            <th>Sort</th>
            <th>Published</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            @foreach($portfolios as $portfolio)
                <tr>
                    <td><a href="{{$portfolio->slug}}">{{{$portfolio->title}}}</a></td>
                    <td>{{$portfolio->order}}</td>
                    <td>{{$portfolio->published}}</td>
                    <td>
                        <a id="portfolio-id-{{$portfolio->id}}"
                           href="/portfolios/{{$portfolio->id}}/edit">
                            edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="/portfolios/create">create portfolio</a>
</div>
@stop