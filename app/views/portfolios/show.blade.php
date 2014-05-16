@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <h1>{{ $portfolio->title }}</h1>
    <p> {{ $portfolio->body }} </p>
    <hr>
    <h3>Related Projects</h3>

    @foreach($portfolio->projects as $p)
        <?php if(empty($p->image)) { $image = 'project3.jpg'; } else { $image = $p->image; } ?>
        <div class="media">
            <img class="media-object col-lg-4" src="/img/projects/{{$image}}" alt="{{$p->title}}">
            <div class="media-body">
                <h4 class="media-heading">{{$p->title}}</h4>
                <p>{{$p->body}}</p>
                @if($p->published == 0)
                    <div class="alert alert-info">Status: not published</div>
                @endif
            </div>
        </div>
    @endforeach

</div>


@stop