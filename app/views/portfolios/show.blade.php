@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <h1>{{ $portfolio->title }}</h1>
    <p> {{ $portfolio->body }} </p>
    <hr>
    <p>Related Projects coming soon</p>
</div>


@stop