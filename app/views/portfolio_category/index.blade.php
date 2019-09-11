@extends('layouts.main')

@section('content')
<div class="col-md-3">
    <div class = "sidebar-nav">
        @include('shared.sidebar')
    </div>
</div>
<div class="col-md-9 column content">
    <h2>Portfolio Categories Page</h2>

    
    <div class="media">
        <div class="media-body">
            <h4 class="media-heading">portfolio categories</h4>
        </div>
    </div>

    @foreach($categories as $category)
    <div class="media">
        <img class="media-object col-lg-4" src="" alt="">
        <div class="media-body">
            <h4 class="media-heading">{{{$category->name}}}</h4>
        </div>
    </div>
    @endforeach

</div>
@stop