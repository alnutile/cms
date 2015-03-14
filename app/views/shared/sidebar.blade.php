<?php //$portfolios = Portfolio::published()->orderByOrder()->get(); ?>




<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default well sidebar-nav">

        <?php
        if(Request::server('PATH_INFO') == '/portfolios') {
            $icon = '<i class="glyphicon glyphicon-th"></i>';
        } else {
            $icon = '';
        }
        ?>
        <div class="panel-heading" role="tab" id="headingOne">
            <a href="#">
                <h4 class="panel-title nav-header" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <big>{{$icon}}&nbsp;Portfolios</big>
                </h4>
            </a>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <ul class="nav nav-list">
                    @foreach($shared_links as $key => $static_menu_item)
                    <?php
                    if(Request::server('PATH_INFO') ==  $static_menu_item) {
                        $active = 'active';
                    } else {
                        $active = 'not-active';
                    }
                    ?>
                    <li class="{{$active}}"> <a href = {{$static_menu_item}}>{{$key}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@include('shared._social')
