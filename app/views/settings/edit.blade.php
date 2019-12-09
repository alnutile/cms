@extends('layouts.main')

@section('content')

<div class="col-md-3 ">
    @include('shared.sidebar')
</div>

<div class="col-md-9 column">
    <legend><i class="glyphicon-cog glyphicon"></i> Update Settings</legend>
    @include('sessions.notice')
    {{ Form::model($setting, array('method' => 'PUT', 'route' => array('settings.update',
        $setting->id), 'files' => 'true', 'role' => 'form')) }}
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
        <div class="form-group">
            <label for="email">Company Name
           @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
            {{ Form::text('name', null, array('class' => 'form-control', 'tabindex' => 1)) }}
            @if($errors->first('name'))
            <div class="alert alert-danger">
                {{  $errors->first('name'); }}
            </div>
            @endif
        </div>

        <div class="form-group">
                <label for="logo">Company Logo Image Uploader 
                @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
                {{ Form::file('logo', null, array('class' => 'form-control', 'tabindex' => 2)) }}
                @if($errors->first('logo'))
                <div class="alert alert-danger">
                    {{  $errors->first('logo'); }}
                </div>
                @endif
                @if($setting->logo) <img src="{{$path}}/{{$setting->logo}}" class="banner-show"> @endif
        </div>
        @if($setting->logo)
            <div class="form-group">
                <div class="controls">
                    <div class="checkbox">
                        <label class="checkbox">{{ Form::checkbox('remove_logo', null) }} Remove Logo</label>
                    </div>
                    <div class="help-block">If you want no logo (Company Name will show).</div>
                </div>
            </div>
        @endif

        @if($settings->theme != true)
        <div class="form-group">
                <label for="email">Colors @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>&nbsp;
                {{ Form::select('color', ['bw' => 'black & white', 'orange' => 'orange', 'green' => 'green', 'blue' => 'blue'], $setting->color, array('class' => 'form-control', 'tabindex' => 4)) }}
                @if($errors->first('color'))
                <div class="alert alert-danger">
                    {{  $errors->first('color'); }}
                </div>
                @endif
        </div>
        @endif
        <div class="form-group">
          <label for="">Portfolio Menu Position</label>
          <select name="portfolio_position" class="form-control">
            <option value="1" @if ($setting->portfolio_menu_position == 1) selected @endif>1</option>
            <option value="2" @if ($setting->portfolio_menu_position == 2) selected @endif>2</option>
            <option value="3" @if ($setting->portfolio_menu_position == 3) selected @endif>3</option>
            <option value="4" @if ($setting->portfolio_menu_position == 4) selected @endif>4</option>
            <option value="5" @if ($setting->portfolio_menu_position == 5) selected @endif>5</option>
            <option value="6" @if ($setting->portfolio_menu_position == 6) selected @endif>6</option>
            <option value="7" @if ($setting->portfolio_menu_position == 7) selected @endif>7</option>
            <option value="8" @if ($setting->portfolio_menu_position == 8) selected @endif>8</option>
            <option value="9" @if ($setting->portfolio_menu_position == 9) selected @endif>9</option>
            <option value="10" @if ($setting->portfolio_menu_position == 10) selected @endif>10</option>
          </select>
        </div>
		<div class="form-group">
                <label for="email">Facebook
			@if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
                {{ Form::text('facebook', null, array('class' => 'form-control', 'tabindex' => 6)) }}
                @if($errors->first('facebook'))
                <div class="alert alert-danger">
                    {{  $errors->first('facebook'); }}
                </div>
                @endif
        </div>

        <div class="form-group">
                <label for="email">Linkedin
                @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
                {{ Form::text('linkedin', null, array('class' => 'form-control', 'tabindex' => 8)) }}
                @if($errors->first('linkedin'))
                <div class="alert alert-danger">
                    {{  $errors->first('linkedin'); }}
                </div>
                @endif
        </div>

        <div class="form-group">
                <label for="email">Twitter
                @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
                {{ Form::text('twitter', null, array('class' => 'form-control', 'tabindex' => 10)) }}
                @if($errors->first('twitter'))
                <div class="alert alert-danger">
                    {{  $errors->first('twitter'); }}
                </div>
                @endif
        </div>

        <div class="form-group">
                <label for="email">Pinterest
                @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
                {{ Form::text('pinterest', null, array('class' => 'form-control', 'tabindex' => 12)) }}
                @if($errors->first('pinterest'))
                <div class="alert alert-danger">
                    {{  $errors->first('pinterest'); }}
                </div>
                @endif
        </div>
        <div class="form-group">
            <label for="email">Google Plus
            @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
            {{ Form::text('gplus', null, array('class' => 'form-control', 'tabindex' => 14)) }}
            @if($errors->first('gplus'))
            <div class="alert alert-danger">
                {{  $errors->first('gplus'); }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="houzz">Houzz
                @if($settings->theme == true)
                    (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
                @endif

                @if($settings->theme == false)
                    (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
                @endif</label>
            {{ Form::text('houzz', null, array('class' => 'form-control', 'tabindex' => 16)) }}
            @if($errors->first('gplus'))
                <div class="alert alert-danger">
                    {{  $errors->first('houzz'); }}
                </div>
            @endif
        </div>
		<div class="form-group">
                <label for="instagram">Instagram
			@if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
                {{ Form::text('instagram', null, array('class' => 'form-control', 'tabindex' => 6)) }}
                @if($errors->first('instagram'))
                <div class="alert alert-danger">
                    {{  $errors->first('instagram'); }}
                </div>
                @endif
        </div>
        <div class="form-group">
            <label>Page Footer
            @if($settings->theme == true)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
            @endif</label>
            {{ Form::textarea('footer', $setting->footer, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
            <div class="help-block">Add your contact, copyright and other info needed.</div>
        </div>
        @if($errors->first('body'))
            <div class="alert alert-danger">
                {{  $errors->first('footer'); }}
            </div>
        @endif
		<div class="form-group">
            <label> 
            {{ Form::textarea('tag_manager_content', $setting->tag_manager_content, array('rows' => 10, 'with' => '100%', 'class' => 'form-control tag_manager_content')) }}
        </div>
		<div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('add_tag_manager_in_header', null,null,array('class' => 'add_tag_manager_in_header','data' => $setting->add_tag_manager_in_header)) }} Check to add tag manager in header </label>
                </div>
                <div class="help-block">Use this to enable or disable tag manager.</div>
            </div>
        </div>
		<div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('maintenance_mode', null) }} Maintenance Mode
						@if($settings->theme == true)
							(<a href="http://corbettresearchgroupinc.com/admin_settings_dark" target="_blank">Help</a>)
						@endif

						@if($settings->theme == false)
						(<a href="http://corbettresearchgroupinc.com/admin_settings_light" target="_blank">Help</a>)
						@endif
					</label>
                </div>
                <div class="help-block">If you want the website hidden from the Visitor AND the search engines, until you are ready to publish.</div>
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('enable_left_nav', (int)$settings->enable_left_nav) }} Check to enable left navigation </label>
                </div>
                <div class="help-block">Use this to enable or disable left navigation.</div>
            </div>
        </div>        
        
        @if(Auth::user() && Auth::user()->admin == 1)
        <div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('theme', null, null, ['id' => 'darktheme','onClick' => 'myCheckbox()']) }} Check to use the dark theme </label>
                </div>
                <div class="help-block">Use this to enable dark theme.</div>
            </div>
        </div>
		@if($settings->theme == TRUE)
		<div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">
						{{ Form::checkbox('view_readmore_status', null) }} Check to disable 'read more' links on projects                            
						@if($settings->theme == TRUE)
							(<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                        @endif

                        @if($settings->theme == FALSE)
							(<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                        @endif
					</label>
                </div>
            </div>
        </div>
		@endif
		<div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('enable_blog', null) }} Check to enable blog </label>
                </div>
                <div class="help-block">Use this to enable or disable your blog.</div>
            </div>
        </div>
		<div class="form-group">
			<div class="controls">
				<div class="checkbox">
					<label class="checkbox">{{ Form::checkbox('enable_portfolio', null, null, ['id' => 'enable_port', 'onClick' => 'myCheckbox()']) }} Check to enable portfolio </label>
				</div>
				<div class="help-block">Use this to enable or disable your portfolio.</div>
			</div>
		</div>
		<div class="form-group" id="multiple_portfolio_ckeck" @if($settings->theme == false) style="display:none" @endif>
			<div class="controls">
				<div class="checkbox">
					<label class="checkbox">{{ Form::checkbox('multiple_portfolio', (int)$settings->multiple_portfolio) }} Check this to enable multiple portfolios. </label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="controls">
				<div class="checkbox">
					<label class="checkbox">{{ Form::checkbox('enable_noindex', null) }} Check to make site not searchable (noindex) </label>
				</div>
				<div class="help-block">Use this to hide your site from the search engines.</div>
			</div>
		</div>
		<div class="form-group">
            <label for="blog_title">Blog Name</label>
                {{ Form::text('blog_title', null, array('class' => 'form-control', 'tabindex' => 1,'placeholder' => "Builder's Notebook")) }}
                @if($errors->first('blog_title'))
                <div class="alert alert-danger">
                    {{  $errors->first('blog_title'); }}
                </div>
                @endif
			<div class="help-block">Enter your blog name here e.g. Builder's Notebook</div>
        </div>
		<div class="form-group">
            <label for="portfolio_title">Portfolio Name</label>
                {{ Form::text('portfolio_title', null, array('class' => 'form-control', 'tabindex' => 1,'placeholder' => "Portfolios")) }}
                @if($errors->first('portfolio_title'))
                <div class="alert alert-danger">
                    {{  $errors->first('portfolio_title'); }}
                </div>
                @endif
			<div class="help-block">Enter your portfolio name here e.g. Builder's Notebook</div>
        </div>
		<div class="form-group">
          <label for="">{{$setting->blog_title}} Menu Position</label>
          <select name="blog_menu_position" class="form-control">
            <option value="1" @if ($setting->blog_menu_position == 1) selected @endif>1</option>
            <option value="2" @if ($setting->blog_menu_position == 2) selected @endif>2</option>
            <option value="3" @if ($setting->blog_menu_position == 3) selected @endif>3</option>
            <option value="4" @if ($setting->blog_menu_position == 4) selected @endif>4</option>
            <option value="5" @if ($setting->blog_menu_position == 5) selected @endif>5</option>
            <option value="6" @if ($setting->blog_menu_position == 6) selected @endif>6</option>
            <option value="7" @if ($setting->blog_menu_position == 7) selected @endif>7</option>
            <option value="8" @if ($setting->blog_menu_position == 8) selected @endif>8</option>
            <option value="9" @if ($setting->blog_menu_position == 9) selected @endif>9</option>
            <option value="10" @if ($setting->blog_menu_position == 10) selected @endif>10</option>
          </select>
        </div>
        <div class="form-group">
            <label for="google_analytics">Google Analytics Code
            {{ Form::text('google_analytics', null, array('class' => 'form-control', 'tabindex' => 1)) }}
            @if($errors->first('google_analytics'))
			<div class="help-block">Enter your google analytics UA number here in the format UA-XXXXX-X</div>
            <div class="alert alert-danger">
                {{  $errors->first('google_analytics'); }}
            </div>
            @endif
        </div>
		@else
            {{ Form::hidden('theme', null) }}

        @endif

        <div class="form-group">
            {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
        </div>
    </fieldset>
    {{ Form::close() }}
</div>
@stop

@section('js')
<script type="text/javascript">
	
	function myCheckbox() {
	  var checkBox = document.getElementById("darktheme");
	  var checkBox1 = document.getElementById("enable_port");
	  var text = document.getElementById("multiple_portfolio_ckeck");
	  if (checkBox.checked == true && checkBox1.checked == true){
		text.style.display = "block";
	  } else {
		 text.style.display = "none";
	  }
	}
	
	$( document ).ready(function() {
		
		var checkBox = document.getElementById("darktheme");
		var checkBox1 = document.getElementById("enable_port");
		var text = document.getElementById("multiple_portfolio_ckeck");
		if (checkBox.checked == true && checkBox1.checked == true){
			text.style.display = "block";
		} else {
			text.style.display = "none";
		}
		
	});
</script>
@stop
