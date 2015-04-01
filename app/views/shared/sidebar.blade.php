<?php //$portfolios = Portfolio::published()->orderByOrder()->get(); ?>



<!-- shared.sidebar -->

@if($settings->theme == true)

@include('shared._sidebar-dark')

@endif

@if($settings->theme != true)

@include('shared._sidebar-light')

@endif
