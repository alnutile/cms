@extends('layouts.main')

@section('content')

    <div class="col-md-3 ">
        @include('shared.sidebar')
    </div>

    <div class="col-md-9 column">

        <h2>Update Project: {{$project->title}} </h2>

        {{ Form::model($project, array('method' => 'PUT', 'route' => array('projects.update', $project->id), 'files' => 'true', 'role' => 'form')) }}


        <div class="form-group">
            <label>Project Name
                @if($settings->theme == TRUE)
                    (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                @endif

                @if($settings->theme == FALSE)
                    (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
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
                    (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                @endif

                @if($settings->theme == FALSE)
                    (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
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
                <label>Project City and/or County (<a href="http://www.restorationtrades.com/help.html#project_city_county" target="_blank">Help</a>)</label>
                {{ Form::text('city_county', NULL, array('class' => 'form-control')) }}
            </div>
            @if($errors->first('city_county'))
                <div class="alert alert-danger">
                    {{  $errors->first('city_county'); }}
                </div>
            @endif

            <div class="form-group">
                <label>Project State and Country (<a href="http://www.restorationtrades.com/help.html#project_state_country" target="_blank">Help</a>)</label>
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
                        (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
                    @endif</label>
                {{ Form::text('city_county', NULL, array('class' => 'form-control')) }}
            </div>
            @if($errors->first('city_county'))
                <div class="alert alert-danger">
                    {{  $errors->first('city_county'); }}
                </div>
            @endif

            <div class="form-group">
                <label>Project Architect
                    @if($settings->theme == TRUE)
                        (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
                    @endif</label>
                {{ Form::text('architect', NULL, array('class' => 'form-control')) }}
            </div>
            @if($errors->first('architect'))
                <div class="alert alert-danger">
                    {{  $errors->first('architect'); }}
                </div>
            @endif
        @endif

        <div class="form-group">
            <label>Project Main Body
                @if($settings->theme == TRUE)
                    (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                @endif

                @if($settings->theme == FALSE)
                    (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
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
                            (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                        @endif

                        @if($settings->theme == FALSE)
                            (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
                        @endif</label>
                </div>
            </div>
        </div>

        @if($settings->theme != TRUE)
            <div class="form-group">
                <label for="email">Related Portfolios</label>&nbsp;
                {{ Form::select('portfolio_id', $portfolios, $project->portfolio_id, array('class' => 'form-control', 'tabindex' => 1)) }}
                @if($errors->first('order'))
                    <div class="alert alert-danger">
                        {{  $errors->first('portfolio_id'); }}
                    </div>
                @endif
            </div>
            @endif

                    <!--sort order-->

            <div class="form-group">
                <label for="order">Sort Order</label>&nbsp;
                {{ Form::selectRange('order', 1, 50, $project->order, array('class' => 'sortOrder', 'tabindex' => 1)) }}
                @if($errors->first('order'))
                    <div class="alert alert-danger">
                        {{  $errors->first('order'); }}
                    </div>
                @endif
            </div>
            @if($settings->theme == TRUE)
                @include('shared.tags', array('model' => 'projects'))
            @endif
            <br>

            <div class="form-group">
                <label>Project Web Address (URL)
                    @if($settings->theme == TRUE)
                        (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
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

                        <!--tile image    -->
                @if($settings->theme == TRUE)
                    <div class="form-group">
                        <label for="email">Project Portfolio ‘Tile’ Image Uploader
                            @if($settings->theme == TRUE)
                                (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                            @endif

                            @if($settings->theme == FALSE)
                                (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
                            @endif</label>
                        {{ Form::file('tile_image', NULL, array('class' => 'form-control', 'tabindex' => 1)) }}
                        @if($errors->first('tile_image'))
                            <div class="alert alert-danger">
                                {{  $errors->first('tile_image') }}
                            </div>
                        @endif
                        @if($project->tile_image)
                            <div class="row">
                                <div>
                                    <img class="col-lg-4" src="/{{$path}}/{{$project->tile_image}}" class="banner-show">
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end tile image-->
                @endif

                <br>
                <br>
                <!-- top image -->
                <div class="form-group">
                    <label for="thumbs">Project Top Image Uploader
                        @if($settings->theme == TRUE)
                            (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                        @endif

                        @if($settings->theme == FALSE)
                            (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
                        @endif</label>
                    {{ Form::file('thumbs', NULL, array('class' => 'form-control', 'tabindex' => 1)) }}
                    @if($errors->first('thumbs'))
                        <div class="alert alert-danger">
                            {{  $errors->first('thumbs') }}
                        </div>
                    @endif
                    {{--new way--}}
                    @if($project->thumbs->url())
                        <div class="row">
                            <div>
                                <img class="col-md-6 img-thumbnail" src="<?= $project->thumbs->url('project_top')?>" class="banner-show">
                            </div>
                        </div>
                    {{--for old way with no image resizing--}}
                    @elseif($project->image)
                        <div class="row">
                            <div>
                                <img class="col-md-6 img-thumbnail" src="/{{$path}}/{{$project->image}}" class="banner-show">
                            </div>
                        </div>
                    @endif
                </div>
                <!-- end top image-->
                <br>
                <br>
                <!-- images upload -->
                <label>Project Subsequent Images Uploader
                    @if($settings->theme == TRUE)
                        (<a href="http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)
                    @endif

                    @if($settings->theme == FALSE)
                        (<a href="http://www.restorationtrades.com/help/admin_projects_light.html" target="_blank">Help</a>)
                    @endif</label>
                @include('shared.images_angular', array('model' => 'projects'))
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
