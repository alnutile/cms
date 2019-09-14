@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>Title</th>
            <th>Sort</th>
            <th>Published</th>
			@if($settings->theme == true)
			<th>Portfolio category</th>
			@endif
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            @foreach($portfolios as $portfolio)
                <tr>
                    <td><a href="{{$portfolio->slug}}">{{{$portfolio->title}}}</a></td>
                    <td>{{$portfolio->order}}</td>
                    <td>{{$portfolio->published}}</td>
					@if($settings->theme == true)
					<td>{{$portfolio->name}}</td>
					@endif
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