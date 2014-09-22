@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
  @include('shared.sidebar')
</div>

<div class="col-md-9 column">

  <h2>Update Project: {{$project->title}} </h2>

  {{ Form::model($project, array('method' => 'PUT', 'route' => array('projects.update', $project->id), 'files' => 'true', 'role' => 'form')) }}


  <div class="form-group">
    <label>Project Name</label>
    {{ Form::text('title', null, array('class' => 'form-control')) }}
    <div class="help-block">Some help here</div>
  </div>
  @if($errors->first('title'))
  <div class="alert alert-danger">
    {{  $errors->first('title'); }}
  </div>
  @endif

  <div class="form-group">
    <label>Seo Title</label>
    {{ Form::text('seo', null, array('class' => 'form-control')) }}
    <div class="help-block">Some help here</div>
  </div>
  @if($errors->first('seo'))
  <div class="alert alert-danger">
    {{  $errors->first('seo'); }}
  </div>
  @endif

  <div class="form-group">
    <label>City and/or County</label>
    {{ Form::text('city_county', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('city_county'))
    <div class="alert alert-danger">
      {{  $errors->first('city_county'); }}
    </div>
  @endif

  <div class="form-group">
    <label>State and Country</label>
    {{ Form::text('state_country', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('state_country'))
  <div class="alert alert-danger">
    {{  $errors->first('state_country'); }}
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
    {{ Form::select('portfolio_id', $portfolios, $project->portfolio_id, array('class' => 'form-control', 'tabindex' => 1)) }}
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
    <label>URL</label>
    {{ Form::text('slug', null, array('class' => 'form-control')) }}
    <div class="help-block">The url must start with / </div>
  </div>
  @if($errors->first('slug'))
  <div class="alert alert-danger">
    @if($errors->first('slug'))
    {{ $errors->first('slug') }}
    @endif
  </div>
  @endif
  <!-- image -->

  <div class="form-group">
    <label for="email">Upload Main Image</label>
    {{ Form::file('image', null, array('class' => 'form-control', 'tabindex' => 1)) }}
    @if($errors->first('image'))
    <div class="alert alert-danger">
      {{  $errors->first('image'); }}
    </div>
    @endif
    @if($project->image)
    <div class="row">
      <div>
        <img  class="col-lg-4" src="/{{$path}}/{{$project->image}}" class="banner-show">
      </div>
    </div>
    @endif
    <div class="help-block">This is the image we will use for the default project image</div>
  </div>

  <br>
  <br>

  <!-- images upload -->

  @include('projects.images_angular')

  <br>
  <br>
  <!-- end images upload -->

  <div class="controls row">
    <div class="col-lg-2">
      {{ Form::submit('Update Project', array('id' => 'submit', 'class' => 'btn btn-success')) }}
      {{ Form::close() }}
    </div>
    <div class="col-lg-2">
      {{ Form::open(array('class' => 'inline', 'method' => 'DELETE', 'route' => array('projects.destroy', $project->id))) }}
      {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete this?")')) }}
      {{ Form::close() }}
    </div>

    <br>
  </div>



</div>


@stop
