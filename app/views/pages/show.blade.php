@extends('layouts.main')
@section('content')


<div class="col-md-4 column sidebar">
    @include('shared.sidebar')
</div>
<div class="col-md-8 column content">
    <h1>{{ $page->title }}</h1>
    <p> {{ $page->body }} </p>
</div>


@stop