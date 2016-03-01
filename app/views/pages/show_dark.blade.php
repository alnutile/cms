@extends('layouts.main')

@section('content')
<!-- pages.show -->
<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
    <div class = "sidebar-nav">
    <div class="mobile-menu"><a href="#"><i class="fa fa-bars"></i></a></div>
        @include('shared.sidebar', array('model' => 'page'))

        @if(Auth::user())
        @if(($settings->theme == true && $page->id != 1) || $settings->theme == false)
        <div class="well text_right">
            Edit this page <br>
            <a href="/pages/{{$page->id}}/edit" class="btn btn-success">Edit</a>
        </div>
        @endif
        @endif
    </div>
</div>
<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 column">
    @if($page->id != 1 || $settings->theme == false)

    @if(isset($page->images) && $settings->theme == true)
    @include('shared.slideshow_angular', array('model' => 'pages'))
    <br>
    @endif

    <h1>{{{ $page->title }}}</h1>
    <p> {{ $page->body }} </p>

    @if($page->id == 4)
    @foreach($projects as $project)
    @include('shared.projects_teasers')
    @endforeach
    {{ $projects->links() }}
    @endif

    @endif
</div>


@stop