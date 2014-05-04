<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>CMS</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.css') }}
    {{ HTML::style('assets/css/colorfrog.css') }}
    <!-- <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'> -->
    {{ HTML::style('assets/css/main.css') }}
    {{ HTML::style('assets/css/prettify.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script('assets/js/html5shiv.js') }}
    {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->

</head>

<body>
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
        <a class="current brand" href="/">Brand Name Here and Link</a>
    </header>
    @include('shared.top-nav')
</div>
<!-- //end container -->

<!-- start header -->
    @if(isset($banner) && $banner == TRUE)
        @include('shared.header')
    @endif

<div class="row"><div class="span12"><hr></div></div>
<!-- //end header -->
    <div class="container content">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12">
                    @include('shared.alerts')
                </div>
            </div>
            @yield('content')
        </div>
    </div>

    @include('shared.footer')

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

{{ HTML::script('/assets/js/jquery-1.11.0.min.js') }}
{{ HTML::script('/assets/js/bootstrap/bootstrap.min.js') }}
{{ HTML::script('/assets/js/jquery.fitvids.js') }}
{{ HTML::script('/assets/js/colorfrog.js') }}
{{ HTML::script('/assets/js/lib/ckeditor-full/ckeditor.js') }}
{{ HTML::script('/assets/js/app.js') }}

</body>
</html>
