<?php //$portfolios = Portfolio::published()->orderByOrder()->get(); dd($shared_links)?>




<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default well sidebar-nav">

        <?php
        if(Request::server('PATH_INFO') == '/portfolios') {
            $icon = '<i class="glyphicon glyphicon-th"></i>';
        } else {
            $icon = '';
        }
        ?>


        <?php
        if(Request::server('PATH_INFO') ==  '/') {
            $active = 'active';
        } else {
            $active = 'not-active';
        }
        ?>
        <div class="panel-heading" role="tab">
            <h4 class="panel-title nav-header" >
                <big> <a href = "/">Home</a></big>
            </h4>
        </div>

        <div class="panel-heading" role="tab" id="headingOne">
            <a href="#">
                <h4 class="panel-title nav-header" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <big><a href="#">{{$icon}}&nbsp;Portfolios</a></big>
                </h4>
            </a>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <ul class="nav nav-list">
                    @foreach($portfolio_links as $key => $portfolio)
                    <?php
                    if(Request::server('PATH_INFO') ==  $portfolio) {
                        $active = 'active';
                    } else {
                        $active = 'not-active';
                    }
                    ?>
                    <li class="{{$active}}"> <a href = {{$portfolio}}>{{$key}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <?php
        if(Request::server('PATH_INFO') ==  '/about') {
            $active = 'active';
        } else {
            $active = 'not-active';
        }
        ?>
        <div class="panel-heading" role="tab">
            <h4 class="panel-title nav-header" >
                <big> <a href = "/about">About Page</a></big>
            </h4>
        </div>

        <?php
        if(Request::server('PATH_INFO') ==  '/contact') {
            $active = 'active';
        } else {
            $active = 'not-active';
        }
        ?>
        <div class="panel-heading" role="tab">
            <h4 class="panel-title nav-header" >
                <big> <a href = "/contact">Contact Page</a></big>
            </h4>
        </div>

    </div>
</div>

@include('shared._social')
