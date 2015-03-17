@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
  @include('shared.sidebar')
</div>

<div class="col-md-9 column">

  <h2>Create Projects:</h2>

  {{ Form::model('project', array('method' => 'POST', 'route' => array('projects.store'), 'files' => 'true', 'role' => 'form')) }}


  <div class="form-group">
    <label>Project Name (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
    {{ Form::text('title', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('title'))
  <div class="alert alert-danger">
    {{  $errors->first('title'); }}
  </div>
  @endif


  <div class="form-group">
    <label>Project Browser Description (a.k.a. Title Tag) (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
    {{ Form::text('seo', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('seo'))
  <div class="alert alert-danger">
    {{  $errors->first('seo'); }}
  </div>
  @endif

  <div class="form-group">
    <label>Project City and/or County (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
    {{ Form::text('city_county', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('city_county'))
    <div class="alert alert-danger">
      {{  $errors->first('city_county'); }}
    </div>
  @endif

  <div class="form-group">
    <label>Project State and Country (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
    {{ Form::text('state_country', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('state_country'))
  <div class="alert alert-danger">
    {{  $errors->first('state_country'); }}
  </div>
  @endif


  <div class="form-group">
    <label>Project Main Body (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
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
        <label class="checkbox">{{ Form::checkbox('published', 1) }} Project Publish Status (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
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
      <label>Project Web Address (URL) (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
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


  <div class="form-group">
    <label for="email">Project Default Image Uploader (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
    {{ Form::file('image', null, array('class' => 'form-control', 'tabindex' => 1)) }}
    @if($errors->first('image'))
    <div class="alert alert-danger">
      {{  $errors->first('image'); }}
    </div>
    @endif
    <div class="help-block">This is the image we will use for the default project image. Landscape orientation is recommended for all project images.</div>
  </div>

  <!-- image -->

    <br>
    <br>

    <!-- images upload -->
<label>Project Blowup Images Uploader (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)</label>
    @include('projects.images_angular')

    <br>
    <br>

  <div class="controls">
    {{ Form::submit('Create Project', array('id' => 'submit', 'class' => 'btn btn-success')) }}
    <br>
  </div>

  {{ Form::close() }}


</div>


@stop
