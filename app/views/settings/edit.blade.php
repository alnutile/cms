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
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
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
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
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
                <label for="email">Colors (<a href="http://www.restorationtrades.com/help.html#colors" target="_blank">Help</a>)</label>&nbsp;
                {{ Form::select('color', ['bw' => 'black & white', 'orange' => 'orange', 'green' => 'green', 'blue' => 'blue'], $setting->color, array('class' => 'form-control', 'tabindex' => 4)) }}
                @if($errors->first('color'))
                <div class="alert alert-danger">
                    {{  $errors->first('color'); }}
                </div>
                @endif
        </div>
        @endif
        
        <div class="form-group">
                <label for="email">Facebook
                @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
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
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
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
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
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
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
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
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
            @endif</label>
            {{ Form::text('gplus', null, array('class' => 'form-control', 'tabindex' => 14)) }}
            @if($errors->first('gplus'))
            <div class="alert alert-danger">
                {{  $errors->first('gplus'); }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Page Footer
            @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
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
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('maintenance_mode', null) }} Maintenance Mode
                    @if($settings->theme == true)
            (<a href="http://www.restorationtrades.com/help/admin_settings_dark.html" target="_blank">Help</a>)
            @endif

            @if($settings->theme == false)
            (<a href="http://www.restorationtrades.com/help/admin_settings_light.html" target="_blank">Help</a>)
            @endif</label>
                </div>
                <div class="help-block">If you want the website hidden from the Visitor AND the search engines, until you are ready to publish.</div>
            </div>
        </div>
        @if(Auth::user() && Auth::user()->admin == 1)
        <div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('theme', null) }} Check to use the dark theme </label>
                </div>
                <div class="help-block">Use this turn set your site to use an alternate theme.</div>
            </div>
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


        @endif

        <div class="form-group">
            {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
        </div>
    </fieldset>
    {{ Form::close() }}
</div>
@stop
