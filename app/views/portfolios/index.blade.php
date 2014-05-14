@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
    <h2>Better layout coming soon</h2>
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>Title</th>
            <th>view</th>
        </tr>
        </thead>
        <tbody>
            @foreach($portfolios as $portfolio)
                <tr>
                    <td><a href="/portfolios/{{$portfolio->id}}">{{$portfolio->title}}</a></td>
                    <td>
                        <a id="portfolio-id-{{$portfolio->id}}"
                           href="/portfolios/{{$portfolio->id}}">view</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop