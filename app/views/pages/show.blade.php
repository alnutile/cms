@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')

    @if(Auth::user())
    <div class="well">
        Edit this page <br>
        <a href="/pages/{{$page->id}}/edit" class="btn btn-success">Edit</a>
    </div>
    @endif
</div>

<div class="col-md-9 column">
    <h1>{{ $page->title }}</h1>
    <p> {{ $page->body }} </p>
</div>


@stop