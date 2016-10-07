@extends('layouts.main')

@section('content')
<!-- pages.create -->

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <h2>Edit Page: {{$page->title or 'Default'}}</h2>
   
	{{ Form::model('pages', array('method' => 'POST', 'route' => array('pages.store'), 'files' => 'true', 'role' => 'form')) }}

    @if(($settings->theme == true) || $settings->theme == false)
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
        @endif

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
        @if(($settings->theme == true) || $settings->theme == false)
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
        @endif
        
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
		
        {{-- @if(Auth::user() && Auth::user()->admin == 1) --}}
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
			@endif

		<div class="form-group">
       {{--  @endif  --}}
        {{-- Added checkbox for publish -JB 2-6-2016 --}}
		<div class="controls">
		  <div class="checkbox">
			<label class="checkbox">{{ Form::checkbox('published', 1) }} Published</label>
		  </div>
		</div>
		<div class="controls">
			  <div class="checkbox">
				<label class="checkbox">{{ Form::checkbox('hide_title', '1','' , array('id' => 'hide_title')); }} Hide title from page</label>
			  </div>
		</div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <div class="checkbox">
              <label class="checkbox">
                <input type="checkbox" id='enable_menu' name='enable_menu' checked> Make this page a menu item
              </label>
            </div>
          </div>
          
          <div id='menu-section'>
            <div class="form-group col-md-2">
              <label for="menu_sort_order">Sort Order</label>
              <select id="menu_sort_order" name="menu_sort_order" class="form-control">
                @foreach (range(0,9) as $n)
                <option value="{{$n}}">{{$n}}</option>
                @endforeach
              </select>
            </div>          
            <div class="form-group col-md-4">
              <label for="menu_name">Type of menu item</label>
              <select id="menu_name" name="menu_name" class="form-control">
                <option value="top,left_side">Top & Left Menu</option>
                <option value="sub_nav">Sub-menu</option>
              </select>
            </div>            
            <div class="form-group col-md-6 hide" id='menu-parent-wrapper'>
              <label for="menu_parent">Parent menu item</label>
              <select id="menu_parent" name="menu_parent" class="form-control">
                @if(!empty($subnavparents))
                  @foreach ($subnavparents as $i)
                    @if(isset($i['id']))
                    <option value="{{$i['id']}}">{{$i['title']}}</option>
                    @endif
                  @endforeach
                @endif
              </select>
            </div>
          </div>
     
          
        </div>
        <div class="controls">
            <br>
            <br>
            {{ Form::submit('Create Page', array('id' => 'submit', 'class' => 'btn btn-success')) }}
            <br>
        </div>      
        {{ Form::close() }}
		{{--
        @if($pages->id >= 5)
        {{ Form::open(['method' => 'DELETE', 'action' => ['PagesController@destroy', $pages->id]]) }}
        <button type="submit" class="btn btn-danger">Delete</button>
        {{ Form::close() }}
          @endif
        --}}
    </div>
    @stop

@section('js')
<script type="text/javascript">

  $(document).on('change','#enable_menu',function(){
    if(this.checked) {
      $('#menu-section').show();
    } else {
      $('#menu-section').hide();
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