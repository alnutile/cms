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
          
        <?php $count = 1; ?>
        
        @foreach($top_left_nav as $top)
        
          @if($settings->portfolio_menu_postion == $count)
          <div class="panel-heading" role="tab" id="headingOne">
            <a href="#"></a>
            <h4 class="panel-title nav-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <a href="#"><big></big></a><big><a href="#">Portfolios</a></big>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height: 0px;">
            <div class="panel-body">
              <ul class="nav nav-list">
                    @foreach($portfolio_links as $key => $portfolio)
                    <li class="@if(Request::server('PATH_INFO') ==  $portfolio) {{'active'}} @else {{'not-active'}} @endif">
                      <a href = {{$portfolio}}>{{$key}}</a>
                    </li>
                    @endforeach
              </ul>
             </div>
          </div>
          @else
          <div class="panel-heading" role="tab">
              <h4 class="panel-title nav-header" >
                  <big> <a href = "{{URL::to($top->slug)}}">{{$top->title}}</a></big>
              </h4>
          </div>            
          @endif
          
          <?php $count++; ?>
          
        @endforeach
        @endif
      
    </div>
</div>

@include('shared._social')
