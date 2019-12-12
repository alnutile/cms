@extends('layouts.main')

@section('content')

    <div class="col-md-3 ">
        @include('shared.sidebar')
    </div>

    <div class="col-md-9 column">

        <h2>Create Projects:</h2>

        {{ Form::model('project', array('method' => 'POST', 'route' => array('projects.store'), 'files' => 'true', 'role' => 'form')) }}


        <div class="form-group">
            <label>Project Name
                @if($settings->theme == TRUE)
                    (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                @endif

                @if($settings->theme == FALSE)
                    (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                @endif</label>
            {{ Form::text('title', NULL, array('class' => 'form-control')) }}
        </div>
        @if($errors->first('title'))
            <div class="alert alert-danger">
                {{  $errors->first('title'); }}
            </div>
        @endif


        <div class="form-group">
            <label>Project Browser Description (a.k.a. Title Tag)
                @if($settings->theme == TRUE)
                    (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                @endif

                @if($settings->theme == FALSE)
                    (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                @endif</label>
            {{ Form::text('seo', NULL, array('class' => 'form-control')) }}
        </div>
        @if($errors->first('seo'))
            <div class="alert alert-danger">
                {{  $errors->first('seo'); }}
            </div>
        @endif

        @if($settings->theme != TRUE)
            <div class="form-group">
                <label>Project City and/or County
                    @if($settings->theme == TRUE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                    @endif</label>
                {{ Form::text('city_county', NULL, array('class' => 'form-control')) }}
            </div>
            @if($errors->first('city_county'))
                <div class="alert alert-danger">
                    {{  $errors->first('city_county'); }}
                </div>
            @endif

            <div class="form-group">
                <label>Project State and Country
                    @if($settings->theme == TRUE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                    @endif</label>
                {{ Form::text('state_country', NULL, array('class' => 'form-control')) }}
            </div>
            @if($errors->first('state_country'))
                <div class="alert alert-danger">
                    {{  $errors->first('state_country'); }}
                </div>
            @endif
        @endif

        @if($settings->theme == TRUE)
            <div class="form-group">
                <label>Project City and State
                    @if($settings->theme == TRUE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                    @endif</label>
                {{ Form::text('city_county', NULL, array('class' => 'form-control')) }}
            </div>
            @if($errors->first('city_county'))
                <div class="alert alert-danger">
                    {{  $errors->first('city_county'); }}
                </div>
            @endif

            
            
			
			<div class="form-group">
                <label>Project Participants 
                    @if($settings->theme == TRUE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                    @endif</label>
					{{ Form::text('participant1', NULL, array('class' => 'form-control','placeholder' => 'ex: Project Manager: John Smith', 'maxlength' => 200)) }}
					@if($errors->first('participant1'))
						<div class="alert alert-danger">
							<br />{{  $errors->first('participant1'); }}<br />
						</div>
					@endif
						<br />
						{{ Form::text('participant2', NULL, array('class' => 'form-control','placeholder' => 'ex: Project Manager: John Smith', 'maxlength' => 200)) }}
					@if($errors->first('participant2'))
						<div class="alert alert-danger">
							<br />{{  $errors->first('participant2'); }}<br />
						</div>
					@endif
					<br />
						{{ Form::text('participant3', NULL, array('class' => 'form-control','placeholder' => 'ex: Project Manager: John Smith', 'maxlength' => 200)) }}
					@if($errors->first('participant3'))
						<div class="alert alert-danger">
							<br />{{  $errors->first('participant3'); }}<br />
						</div>
					@endif
					
					
            </div>
            
        @endif

        <div class="form-group">
            <label>Project Main Body
                @if($settings->theme == TRUE)
                    (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                @endif

                @if($settings->theme == FALSE)
                    (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                @endif</label>
            {{ Form::textarea('body', NULL, array('rows' => 30, 'class' => 'ckeditor form-control')) }}
        </div>
        @if($errors->first('body'))
            <div class="alert alert-danger">
                {{  $errors->first('body'); }}
            </div>
        @endif

        <div class="form-group">
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('published', 1) }} Project Publish Status
                        @if($settings->theme == TRUE)
                            (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                        @endif

                        @if($settings->theme == FALSE)
                            (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                        @endif</label>
                </div>
            </div>
        </div>
        @if($settings->theme != TRUE)
            <div class="form-group">
                <label for="email">Related Portfolios</label>&nbsp;
                {{ Form::select('portfolio_id', $portfolios, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('order'))
                    <div class="alert alert-danger">
                        {{  $errors->first('portfolio_id'); }}
                    </div>
                @endif
            </div>
		@else
			<div class="form-group hide">
                <label for="email">Related Portfolios</label>&nbsp;
                {{ Form::select('portfolio_id', ['0'=>'0'], array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('order'))
                    <div class="alert alert-danger">
                        {{  $errors->first('portfolio_id'); }}
                    </div>
                @endif
            </div>
        @endif
		@if($settings->theme == TRUE)
            <div class="form-group">
                <label for="email">Project Category (Optional)</label>&nbsp;
                {{ Form::select('project_category',array( 0 =>'Select') + $category, '', array('class' => 'form-control','name'=>'project_category')) }}
				@if($errors->first('order'))
                    <div class="alert alert-danger">
                        {{  $errors->first('project_category'); }}
                    </div>
                @endif
            </div>
        @endif
                    <!--sort order-->

            <div class="form-group">
                <label for="email">Sort Order</label>&nbsp;
                {{ Form::selectRange('order', 1, 50, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('order'))
                    <div class="alert alert-danger">
                        {{  $errors->first('order'); }}
                    </div>
                @endif
            </div>
            @if($settings->theme == TRUE)
                @include('shared.tags_create', array('model' => 'projects'))
            @endif

            <br>

            <div class="form-group">
                <label>Project Web Address (URL)
                    @if($settings->theme == TRUE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                    @endif</label>
                {{ Form::text('slug', NULL, array('class' => 'form-control')) }}
                <div class="help-block">The url must start with /</div>
            </div>
            @if($errors->first('slug'))
                <div class="alert alert-danger">
                    @if($errors->first('slug'))
                        {{ $errors->first('slug') }}
                    @endif
                </div>
            @endif

            <br>
            <br>

            <!--tile image-->
            @if($settings->theme == TRUE)
                <div class="form-group">
                    <label for="email">Project Portfolio ‘Tile’ Image Uploader
                        @if($settings->theme == TRUE)
                            (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                        @endif

                        @if($settings->theme == FALSE)
                            (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                        @endif</label>
                    {{ Form::file('tile_image', NULL, array('class' => 'form-control', 'tabindex' => 1)) }}
                    @if($errors->first('tile_image'))
                        <div class="alert alert-danger">
                            {{  $errors->first('tile_image'); }}
                        </div>
                    @endif
                </div>
                @endif
                        <!-- end tile image -->

                <br>
                <br>
                <!--    top image-->
                <div class="form-group">
                    <label for="thumbs">Project Top Image Uploader
                        @if($settings->theme == TRUE)
                            (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                        @endif

                        @if($settings->theme == FALSE)
                            (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                        @endif</label>
                    {{ Form::file('thumbs', NULL, array('class' => 'form-control', 'tabindex' => 1)) }}
                    @if($errors->first('thumbs'))
                        <div class="alert alert-danger">
                            {{  $errors->first('thumbs') }}
                        </div>
                    @endif

                </div>
				<!--end top image-->
                <br>
                <br>
                <!-- images upload -->
                <label>Project Subsequent Images Uploader
                    @if($settings->theme == TRUE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_dark" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://corbettresearchgroupinc.com/admin_projects_light" target="_blank">Help</a>)
                    @endif</label>
                @include('shared.images_angular', array('model' => 'projects'))
                <br>
                <br>

                <div class="controls">
                    {{ Form::submit('Create Project', array('id' => 'submit', 'class' => 'btn btn-success')) }}
                    <br>
                </div>

                {{ Form::close() }}


    </div>


@stop
