<?php //$portfolios = Portfolio::published()->orderByOrder()->get(); dd($shared_links)?>




<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default well sidebar-nav">

        <?php
        if(Request::server('PATH_INFO') == '/portfolios') {
            $icon = '<i class="glyphicon glyphicon-th">&nbsp;</i>';
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
        @if(isset($top_left_nav))
        @foreach($top_left_nav as $top)
        <div class="panel-heading" role="tab">
            <h4 class="panel-title nav-header" >
                <big> <a href = "{{URL::to($top->slug)}}">{{$top->title}}</a></big>
            </h4>
        </div>
      @endforeach
      @endif
      
    </div>
</div>

@include('shared._social')
