@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
  @include('portfolios._related_projects')
</div>

<div class="col-md-9 column">

  <h2>Edit Portfolio: {{$portfolio->title}}</h2>

  {{ Form::model($portfolio, array('method' => 'PUT', 'route' => array('portfolios.update', $portfolio->id), 'role' => 'form')) }}


  <div class="form-group">
    <label>Portfolio Name <a href="http://restorationtrades.com/help#portfolio_name">Help</a></label>
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
    <label>Header</label>
    {{ Form::text('header', null, array('class' => 'form-control')) }}
  </div>
  @if($errors->first('header'))
  <div class="alert alert-danger">
    {{  $errors->first('header'); }}
  </div>
  @endif

  <div class="form-group">
    <label>Description</label>
    {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
  </div>
  @if($errors->first('body'))
  <div class="alert alert-danger">
    {{  $errors->first('body'); }}
  </div>
  @endif

  @if(Auth::user()->admin == 1)
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
  @endif

  <div class="form-group">
    <div class="controls">
      <div class="checkbox">
        <label class="checkbox">{{ Form::checkbox('published', 1) }} Published</label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="order">Sort Order</label>&nbsp;
    {{ Form::selectRange('order', 1, 10, $portfolio->order, array('class' => 'form-control', 'tabindex' => 1)) }}
    @if($errors->first('order'))
    <div class="alert alert-danger">
      {{  $errors->first('order'); }}
    </div>
    @endif
  </div>

  <div class="controls">
    {{ Form::submit('Update Portfolio', array('id' => 'submit', 'class' => 'btn btn-success')) }}
    <br>
  </div>

  {{ Form::close() }}

  @if($portfolio->id >= 5)
  {{ Form::open(['method' => 'DELETE', 'action' => ['PortfoliosController@destroy', $portfolio->id]]) }}
  <button type="submit" class="btn btn-danger">Delete</button>
  {{ Form::close() }}
  @endif
</div>


@stop
