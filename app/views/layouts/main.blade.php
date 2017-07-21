<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon2.png">

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
    {{ HTML::style('assets/css/houzz/css/houzz-icon-font.css') }}

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
    {{ HTML::style('assets/css/customProject.css') }}




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
        <a href="/" id="logo">{{ HTML::image("/img/settings/{$settings->logo}", $settings->name)}}</a>
        @endif
    
		@if($settings->theme == false)
		@include('shared.top-nav')
		@endif
	</header>
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
	<!-- Delete confirm modal starts here -->
	<div id="delete_confirmation"  class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="title aligncenter">{{$settings->name}}</h2>
				</div>
				<div class="modal-body aligncenter">
					<p>Are you sure you want to delete this?</p>
				</div>
				<div class="modal-footer aligncenter">
					<p><button type="button" class="btn btn-info" data-dismiss="modal" id="delete">OK</button></p>
					<p><a class="btn-cancel" href="javascript:void(0)" data-dismiss="modal">Cancel</a></p>
				</div>
			</div>
		</div>
	</div>
<!-- modal ends here -->
</div>

@include('shared.footer')

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
window.theme = {{$settings->theme}};
</script>
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
{{ HTML::script('/assets/js/naturalSortVersionDates.min.js') }}
{{ HTML::script('/assets/js/custom.js') }}
<script type="text/javascript">
	// Add padding to top of body tag if logged into admin on both themes
	jQuery(function($) {
		if ($('.navbar-fixed-top').length) {
			$('body').css('padding-top','30px');
		}
		if ($('.container.login').length) {
			$('.main_content').css('padding-top','initial');
		}
	// Functionality for mobile menu on dark theme.
		window_size = $(document).width() <= 767 ? true : false;
		if (window_size) {
			$('ul.nav-list').addClass('hide-menu');
			$('.border').addClass('hide-line');
			$('.mobile-menu a').click(function () {
				$('ul.nav-list').slideToggle();
				$('.border').toggleClass('hide-line');
				$('.mobile-menu a').toggleClass('active');
			});
		}
		// resizes gray background image on dark theme
		if ($('.navbar.navbar-fixed-top').length && (window_size)) {
				$('body').css('background-size', 'auto 149px');
				$('#social, .col-md-3').css('display','none');
		}
		// hides mobile menu on homepage for dark theme
		if($('body.home').length) {
 			$('ul.nav-list').css('display','block');
 			$('.mobile-menu').css('display','none');
 		}
		
	});
</script>
<script type="text/javascript">
	// Functionality for mobile menu on light theme.
	$(window).load(function(){
		var window_light_size = $(window).width() <= 767 ? true : false;
		if (window_light_size) {
			$('.mobile-menu.light-theme').show();
			$('#accordion').hide();
			$('.mobile-menu.light-theme a').click(function(){
				$('#accordion').slideToggle();
				$('.border').toggleClass('hide-line');
				$('.mobile-menu.light-theme a').toggleClass('active');
			});
		}
		else{
			$('.mobile-menu.light-theme').hide();
		}
	});
	

	$(document).on("click", ".delete", function(event){
		event.preventDefault();
		var $form=$(this).closest('form');
		$('#delete_confirmation').modal({ backdrop: 'static', keyboard: false })
			.one('click', '#delete', function() {
				$form.trigger('submit'); // submit the form
		});
	});
</script>
@yield('js')
</body>
</html>
