@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
  @include('shared.sidebar')
</div>

<div class="col-md-9 column">

  <h2>Create Portfolio category :</h2>

  {{ Form::model('portfolio_category', array('method' => 'POST', 'route' => array('portfolio_categories.store'), 'role' => 'form')) }}


  <div class="form-group">
    <label>Portfolio Category Name </label>
    {{ Form::text('name', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('name'))
    <div class="alert alert-danger">
      {{  $errors->first('name'); }}
    </div>
  @endif
  
  <div class="form-group">
    <label>Portfolio Category Browser Description (a.k.a Title Tag)
		@if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_pages_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_pages_light" target="_blank">Help</a>)
            @endif</label>
	</label>
    {{ Form::text('desc', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('desc'))
    <div class="alert alert-danger">
      {{  $errors->first('desc'); }}
    </div>
  @endif
  <div class="form-group">
		<label>Portfolio category Main Body 
		@if($settings->theme == true)
		(<a href="http://corbettresearchgroupinc.com/admin_pages_dark" target="_blank">Help</a>)
		@endif

		@if($settings->theme == false)
		(<a href="http://corbettresearchgroupinc.com/admin_pages_light" target="_blank">Help</a>)
		@endif</label>
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
        <label class="checkbox">{{ Form::checkbox('isactive', 1) }} Is Active</label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label>Slug</label>
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

  <div class="controls">
    {{ Form::submit('Create Portfolio category', array('id' => 'submit', 'class' => 'btn btn-success')) }}
    <br>
  </div>

  {{ Form::close() }}


</div>


@stop
