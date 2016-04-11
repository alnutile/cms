@extends('layouts.main')

@section('content')
<!-- pages.edit -->

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">

    <h2>Edit Page: {{$page->title}}</h2>

    {{ Form::model($page, array('method' => 'PUT', 'route' => array('pages.update', $page->id), 'files' => 'true', 'role' => 'form')) }}

    {{-- @if(($settings->theme == true && $page->id != 1) || $settings->theme == false) --}}
    <div class="form-group">
        <label>Page Heading
            @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
        {{ Form::text('title', null, array('class' => 'form-control')) }}

			@if($errors->first('title'))
			<div class="alert alert-danger">
				{{  $errors->first('title'); }}
			</div>
			@endif
        {{-- @endif --}}

        <div class="form-group">
            <label>Page Browser Description (a.k.a. Title Tag) 
            @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
            {{ Form::text('seo', null, array('class' => 'form-control')) }}
        </div>
        @if($errors->first('seo'))
        <div class="alert alert-danger">
            {{  $errors->first('seo'); }}
        </div>
        @endif
       {{-- @if(($settings->theme == true && $page->id != 1) || $settings->theme == false) --}}
        <div class="form-group">
            <label>Page Main Body 
            @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
            {{ Form::textarea('body', null, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
        </div>
        @if($errors->first('body'))
        <div class="alert alert-danger">
            {{  $errors->first('body'); }}
        </div>
        @endif
        {{--@endif --}}
        
		{{--
        @if($settings->theme = true)  // Removed $slideshow variable - $slideshow == true && 
        <!-- images upload -->
        <label>Project Blowup Images Uploader
			@if($settings->theme == true)
				(<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
        @include('shared.images_angular', array('model' => 'pages'))
        <br>
        <br>
        <!-- end images upload -->
        @endif
		--}}
        {{-- @if(Auth::user()) --}}
        <div class="form-group">
            <label>Page Web Address (URL) 
			@if($settings->theme == true)
				(<a href="http://www.restorationtrades.com/help/admin_pages_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
				(<a href="http://www.restorationtrades.com/help/admin_pages_light.html" target="_blank">Help</a>)
            @endif</label>
				{{ Form::text('slug', null, array('class' => 'form-control')) }}
            <div class="help-block">The url must start with / </div>
		</div>
			@if($errors->first('slug'))
				<div class="alert alert-danger">
					@if($errors->first('slug'))
					{{ $errors->first('slug') }}
					@endif
				</div>
		<div class="form-group">
			@endif
        {{-- @endif --}}
        {{-- Added checkbox for publish -JB 3-4-2016 --}}
			<div class="controls">
			  <div class="checkbox">
				<label class="checkbox">{{ Form::checkbox('published', 1) }} Published</label>
			  </div>
			</div>

        <div class="row">
          <div class="form-group col-md-12">
            <div class="checkbox">
              <label class="checkbox">
                {{ Form::checkbox('enable_menu', '1', $page->menu_name , array('id' => 'enable_menu')); }} Enable Menu Item
              </label>
            </div>
          </div>
          
          <div id='menu-section' class=" @if ($page->menu_name == "") {{ 'hide'}} @endif">
            <div class="form-group col-md-2">
              <label for="menu_sort_order">Sort Order</label>
              {{Form::select('menu_sort_order', range(0,10), $page->menu_sort_order, array('class'=>'form-control'));}}
              </select>
            </div>          
            <div class="form-group col-md-4">
              <label for="menu_name">Menu Name</label>
              <select id="menu_name" name="menu_name" class="form-control">
                <option value="top,left_side" @if($page->menu_name == 'top,left_side') selected @endif>Top & Left Side</option>
                <option value="sub_nav" @if($page->menu_name == 'sub_nav') selected @endif>Sub Nav</option>
              </select>
            </div>            
            <div class="form-group col-md-6 @if($page->menu_name != 'sub_nav') {{ 'hide' }} @endif" id='menu-parent-wrapper'>
              <label for="menu_parent">Parent Menu Item</label>
              <select id="menu_parent" name="menu_parent" class="form-control">
                @if(!empty($subnavparents))
                @foreach ($subnavparents as $i)
                <option value="{{$i['id']}}" @if($page->menu_parent == $i['id']) {{ $i['title'] }} selected @endif>{{$i['title']}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
     
          
        </div>
<br><br>
			<div class="controls">
				{{ Form::submit('Update Page', array('id' => 'submit', 'class' => 'btn btn-success')) }}
				<br>
			</div>
		</div>
        {{ Form::close() }}

        @if($page->id >= 5)
        {{ Form::open(['method' => 'DELETE', 'action' => ['PagesController@destroy', $page->id]]) }}
        <button type="submit" class="btn btn-danger">Delete</button>
        {{ Form::close() }}
        @endif
    </div>
    @stop
  @section('js')
<script type="text/javascript">

  $(document).on('change','#enable_menu',function(){
    if(this.checked) {
      $('#menu-section').removeClass('hide');
      
    } else {
      $('#menu-section').addClass('hide');
     
    }
  });  
  
  $(document).on('change','#menu_name',function(){
    if(this.value == 'sub_nav') {
      $('#menu-parent-wrapper').removeClass('hide');
    } else {
      $('#menu-parent-wrapper').addClass('hide');
    }
  });

</script>
@stop
