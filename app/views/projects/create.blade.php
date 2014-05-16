@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">

    <h2>Create Projects:</h2>

    {{ Form::model('project', array('method' => 'POST', 'route' => array('projects.store'), 'role' => 'form')) }}


    <div class="form-group">
        <label>Title</label>
        {{ Form::text('title', null, array('class' => 'form-control')) }}
    </div>
    @if($errors->first('title'))
    <div class="alert alert-danger">
        {{  $errors->first('title'); }}
    </div>
    @endif


    <div class="form-group">
        <label>Seo Title</label>
        {{ Form::text('seo', null, array('class' => 'form-control')) }}
    </div>
    @if($errors->first('seo'))
    <div class="alert alert-danger">
        {{  $errors->first('seo'); }}
    </div>
    @endif


    <div class="form-group">
        <label>Body</label>
        {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
    </div>
    @if($errors->first('body'))
    <div class="alert alert-danger">
        {{  $errors->first('body'); }}
    </div>
    @endif

    <div class="form-group">
        <div class="controls">
            <div class="checkbox">
                <label class="checkbox">{{ Form::checkbox('published', 1) }} Published</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Related Portfolios</label>&nbsp;
        {{ Form::select('portfolio_id', $portfolios, array('class' => 'form-control', 'tabindex' => 1)) }}
        @if($errors->first('order'))
        <div class="alert alert-danger">
            {{  $errors->first('portfolio_id'); }}
        </div>
        @endif
    </div>

    <!--sort order-->

    <div class="form-group">
        <label for="email">Sort Order</label>&nbsp;
        {{ Form::selectRange('order', 1, 10, array('class' => 'form-control', 'tabindex' => 1)) }}
        @if($errors->first('order'))
        <div class="alert alert-danger">
            {{  $errors->first('order'); }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label for="email">Upload File</label>
        {{ Form::file('image', null, array('class' => 'form-control', 'tabindex' => 1)) }}
        @if($errors->first('image'))
        <div class="alert alert-danger">
            {{  $errors->first('image'); }}
        </div>
        @endif
    </div>

    <!-- image -->

    <div class="controls">
        {{ Form::submit('Create Project', array('id' => 'submit', 'class' => 'btn btn-success')) }}
        <br>
    </div>

    {{ Form::close() }}


</div>


@stop