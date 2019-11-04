@extends('layouts.main')

@section('content')


<div class="col-md-12 column">

  <h2>Edit Portfolio: {{$categories->name}}</h2>

  {{ Form::model($categories, array('method' => 'PUT', 'route' => array('portfolio_categories.update', $categories->id), 'role' => 'form')) }}


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

  <div class="form-group">
    <div class="controls">
      <div class="checkbox">
       <?php $checked = ($categories->is_active == 1) ? "checked" : ""; ?>	  
        <label class="checkbox">{{ Form::checkbox('isactive', 1, $checked) }} Is Active</label>
      </div>
    </div>
  </div>

  <div class="controls">
    {{ Form::submit('Update Portfolio', array('id' => 'submit', 'class' => 'btn btn-success')) }}
    <br>
  </div>

  {{ Form::close() }}
  {{ Form::open(['method' => 'DELETE', 'action' => ['PortfolioCategoryController@destroy', $categories->id]]) }}
  <button type="submit" class="btn btn-danger delete">Delete</button>
  {{ Form::close() }}
</div>


@stop
