@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <h1>{{ $page->title }}</h1>
    <p> {{ $page->body }} </p>
</div>


@stop