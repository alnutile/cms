@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>Preview</th>
            <th>Name</th>
            <th>Active</th>
            <th>Sort</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($banners as $banner)
        <tr>
            <td><img src="{{$path}}/{{{$banner->banner_name}}}" class="banner-index"></td>
            <td><a href="/banners/{{$banner->id}}/edit">{{{$banner->name}}}</a></td>
            <td>{{$banner->active}}</td>
            <td>{{$banner->order}}</td>
            <td><a id="banner-id-{{$banner->id}}" href="/banners/{{$banner->id}}/edit">edit</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="/banners/create">create banner</a>
</div>
@stop