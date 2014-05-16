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
            <h4>{{$icon}}&nbsp;Portfolio</h4>
        </li>
        @foreach($portfolios as $portfolio)
            <?php
                if(Request::server('PATH_INFO') == $portfolio->slug) {
                     $active = 'active';
                } else {
                     $active = 'not-active';
                }
            ?>
            <li class="{{$active}}"><a href="{{$portfolio->slug}}">{{$portfolio->title}}</a></li>
        @endforeach
            <!-- all projects -->
            <?php
                $project = Page::find(4);
                if(Request::server('PATH_INFO') == $project->slug) {
                    $active = 'active';
                } else {
                    $active = 'not-active';
                }
            ?>
            <li class="{{$active}}"><a href="{{$project->slug}}">{{$project->title}}</a></li>
        </ul>
@endif
</div>

@include('shared._social')
