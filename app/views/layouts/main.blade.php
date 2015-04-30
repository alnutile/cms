<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>
        @if(isset($seo))
        {{$seo}}
        @else
        {{$settings->name}}
        @endif
    </title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.css') }}

    {{ HTML::style('assets/css/font-awesome.css') }}
    <!-- <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'> -->
    {{ HTML::style('assets/css/prettify.css') }}
    {{ HTML::style('assets/css/main.css') }}
    {{ HTML::style('assets/css/custom.css') }}
      {{ HTML::style('assets/css/customProject.css') }}
    {{ HTML::style('/bower_components/ng-tags-input/ng-tags-input.bootstrap.min.css') }}
    {{ HTML::style('/bower_components/ng-tags-input/ng-tags-input.min.css') }}
    {{ HTML::style('/bower_components/jquery-colorbox/example4/colorbox.css') }}

    @if($settings->theme == false)
    {{ HTML::style('assets/css/colorfrog.css') }}
    {{ HTML::style('assets/css/originalTheme.css') }}
    @endif
    @if($settings->theme == true)
    {{ HTML::style('assets/css/dark.css') }}
    {{ HTML::style('/bower_components/flexslider/flexslider.css') }}

    @endif



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script('assets/js/html5shiv.js') }}
    {{ HTML::script('assets/js/respond.min.js') }}

    <![endif]-->


    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '{{$settings->google_analytics}}']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>


</head>

<body class="{{$settings->color}}">
<!--
Use the corresponding body tag for your chosen theme
<body class="blue">
<body class="orange">
<body class="green">
<body class="bw">
-->

@if(Auth::user())
@include('shared.nav')
@endif
<!-- //start container -->
<div class="container">
    <header>
        @if($settings->logo && $settings->theme == false)
        <a href="/">{{ HTML::image("/img/settings/{$settings->logo}", $settings->name)}}</a>
        @elseif ($settings->theme == false)
        <h2><a href="/">{{$settings->name}}</a></h2>
        @endif
    </header>
    @if($settings->theme == false)
    @include('shared.top-nav')
    @endif

</div>
<!-- //end container -->

<!-- start header -->

@if(isset($banner) && $banner == TRUE)
@include('shared.header')
@endif

<div class="row"><div class="span12"><hr></div></div>
<!-- //end header -->
<div class="container content main_content">
    <div class="row">
        <!--alerts-->
        @if (Session::has('message'))
        <div class="row clearfix">
            <div class="col-lg-12">
                @include('shared.alerts')
            </div>
        </div>
        @endif


        @if($settings->maintenance_mode == 1)
        <div class="alert alert-danger">
            Your site is in maintenance mode. Only logged in users can see the site.
            <br>
            Visit <a href="/settings/1/edit">Settings</a> to change it.
        </div>
        @endif
        @yield('content')
    </div>
</div>

@include('shared.footer')

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

{{ HTML::script('/assets/js/jquery-1.11.js') }}
{{ HTML::script('/assets/js/noty-2.2.2/js/noty/packaged/jquery.noty.packaged.min.js') }}
{{ HTML::script('/assets/js/jquery-sortable.js') }}
{{ HTML::script('/assets/js/bootstrap/bootstrap.min.js') }}
{{ HTML::script('/assets/js/jquery.fitvids.js') }}
{{ HTML::script('/assets/js/colorfrog.js') }}
{{ HTML::script('/assets/js/lib/ckeditor-full/ckeditor.js') }}
{{ HTML::script('/bower_components/angular/angular.js') }}
{{ HTML::script('/bower_components/lodash/dist/lodash.js') }}
{{ HTML::script('/bower_components/restangular/dist/restangular.js') }}
{{ HTML::script('/bower_components/jquery-colorbox/jquery.colorbox-min.js') }}
{{ HTML::script('/bower_components/readmore/readmore.min.js') }}
<!--{{ HTML::script('/bower_components/jquery-ui/jquery-ui.min.js') }}-->
<!--{{ HTML::script('/bower_components/jquery-ui/ui/minified/sortable.min.js') }}-->
<!--{{ HTML::script('/bower_components/flow.js/dist/flow.js') }}-->
{{ HTML::script('/bower_components/ng-flow/dist/ng-flow-standalone.js') }}
{{ HTML::script('/assets/js/app.js') }}
<!--{{ HTML::script('/assets/js/cms_flow.js') }}-->
{{ HTML::script('/assets/js/angular_app.js') }}
{{ HTML::script('/assets/js/alertServices.js') }}
{{ HTML::script('/assets/js/uploadImagesCtrl.js') }}
{{ HTML::script('/assets/js/tagsCtrl.js') }}
{{ HTML::script('/bower_components/ng-tags-input/ng-tags-input.min.js') }}
@if($settings->theme == true)
{{ HTML::script('http://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js') }}
@endif

{{ HTML::script('/bower_components/flexslider/jquery.flexslider.js') }}
{{ HTML::script('/bower_components/angular-flexslider/angular-flexslider.js') }}


</body>
</html>
