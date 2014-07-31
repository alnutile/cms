@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
    <h2>Portfolio Page</h2>

    @foreach($portfolios as $p)
    <?php
        $project = $p->projects->first();
        if(empty($project->image)) {
            $image = 'project3.jpg';
        } else {
            $image = $project->image;
        }
    ?>
    <div class="media">
        <img class="media-object col-lg-4" src="/img/projects/{{$image}}" alt="{{$p->title}}">
        <div class="media-body">
            <h4 class="media-heading">{{{$p->title}}}</h4>
            <p>{{$p->body}}</p>
            <br>
            <a id="portfolio-id-{{$p->id}}"
               href="/portfolios/{{$p->id}}">view all projects</a>
        </div>
    </div>
    @endforeach

</div>
@stop