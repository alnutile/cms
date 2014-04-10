<!DOCTYPE html>
<html lang="en" ng-app="cms">
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
    {{ HTML::style('assets/css/main.css') }}
    {{ HTML::style('assets/css/prettify.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script('assets/js/html5shiv.js') }}
    {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->

</head>

<body>
<div class="container">

    <div class="row clearfix">
        <div class="row clearfix content">
            @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('message') }}</div>
            @endif
            <ng-view></ng-view>
        </div>
    </div>

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

{{ HTML::script('/assets/js/jquery-1.11.0.min.js') }}
{{ HTML::script('/assets/js/cms/app/lib/angular/angular.js') }}
{{ HTML::script('/assets/js/cms/app/lib/angular/angular-sanitize.js') }}
{{ HTML::script('/assets/js/cms/app/lib/angular/angular-resource.js') }}
{{ HTML::script('/assets/js/cms/app/lib/angular/angular-route.js') }}
{{ HTML::script('/assets/js/cms/app/lib/angular/angular-sanitize.js') }}
{{ HTML::script('/assets/js/cms/app/lib/angular/angular-loader.js') }}
{{ HTML::script('/assets/js/angular-ui/ui-bootstrap-tpls-0.10.0.js') }}
{{ HTML::script('/assets/js/cms/app/js/controllers/adminPages.js') }}
{{ HTML::script('/assets/js/cms/app/js/controllers/adminUsers.js') }}
{{ HTML::script('/assets/js/cms/app/js/services/auth_interceptor.js') }}
{{ HTML::script('/assets/js/cms/app/js/services/adminMenu.js') }}
{{ HTML::script('/assets/js/cms/app/js/services/currentUser.js') }}
{{ HTML::script('/assets/js/cms/app/js/services/users_services.js') }}
{{ HTML::script('/assets/js/cms/app/js/services/pages_services.js') }}
{{ HTML::script('/assets/js/cms/app/js/services/helpers.js') }}
{{ HTML::script('/assets/js/cms/app/js/services/alertServices.js') }}
{{ HTML::script('/assets/js/cms/app/js/directives/directives.js') }}
{{ HTML::script('/assets/js/cms/app/js/filters/filters.js') }}
{{ HTML::script('/assets/js/cms/app/js/app.js') }}
<script>
    angular.module("cms").constant("CSRF_TOKEN", '{{ csrf_token() }}');
</script>

</body>
</html>