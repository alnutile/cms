<?php //$portfolios = Portfolio::published()->orderByOrder()->get(); ?>




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
      <h4>{{$icon}}&nbsp;Links</h4>
    </li>
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

@include('shared._social')
