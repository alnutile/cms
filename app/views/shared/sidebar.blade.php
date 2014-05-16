<?php $portfolios = Portfolio::published()->orderByOrder()->get(); ?>

@if(!$portfolios)
    <!-- no portfolio items -->
@else
<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <?php
            if(Request::server('PATH_INFO') == '/portfolios') {
                $icon = '<i class="glyphicon glyphicon-th"></i>';
            } else {
                $icon = '';
            }
        ?>
        <li class="nav-header">
            <h4>{{$icon}}&nbsp;<a href="/portfolios">Portfolio</a></h4>
        </li>
        @foreach($portfolios as $portfolio)
            <?php
                if(Request::server('PATH_INFO') == '/portfolios/' . $portfolio->id) {
                     $active = 'active';
                } else {
                     $active = 'not-active';
                }
            ?>
            <li class="{{$active}}"><a href="/portfolios/{{$portfolio->id}}">{{$portfolio->title}}</a></li>
        @endforeach
        </ul>
@endif
</div>

@include('shared._social')
