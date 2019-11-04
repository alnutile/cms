<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon2.png">

    <title>Page not found - {{$settings->name}}</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.css') }}

    {{ HTML::style('assets/css/font-awesome.css') }}
    <!-- <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'> -->
    {{ HTML::style('assets/css/prettify.css') }}
    {{ HTML::style('assets/css/main.css') }}
    {{ HTML::style('assets/css/custom.css') }}
	@if(file_exists(public_path().'/assets/css/customProject.css'))
    {{ HTML::style('assets/css/customProject.css') }}
	@endif
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
			<?php 
				$portfolios      = Portfolio::published()->orderByOrder()->get();
				if ($portfolios) {
					foreach ($portfolios as $key => $portfolio) {
						$portfolio_links[$portfolio->title] = $portfolio->slug;
					}
				}
				View::share('portfolio_links', $portfolio_links);
			?>
			@include('shared.top-nav')
		@endif
    </header>
</div>
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
		@if($settings->theme == true)
			<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
				<div class = "sidebar-nav">
					<div class="mobile-menu"><a href="#"><i class="fa fa-bars"></i></a></div>
					@include('shared.sidebar', array('model' => 'page'))
				</div>
			</div>
			<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 column">
				@yield('content')
			</div>
		@else
			@yield('content')	
		@endif
		
    </div>
</div>

@include('shared.footer')

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

{{ HTML::script('/assets/js/jquery-1.11.js') }}
@if(file_exists(public_path().'/assets/js/custom.js'))
{{ HTML::script('/assets/js/custom.js') }}
@endif

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
 			// $('ul.nav-list').css('display','block');
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
</script>
@yield('js')
</body>
</html>
