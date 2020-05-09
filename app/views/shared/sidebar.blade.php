<?php //$portfolios = Portfolio::published()->orderByOrder()->get(); ?>



<!-- shared.sidebar -->

@if($settings->theme == true && $settings->enable_left_nav)
	@include('shared._sidebar-dark')
@endif
@if($settings->theme != true && $settings->enable_left_nav)
	@include('shared._sidebar-light')
@endif
