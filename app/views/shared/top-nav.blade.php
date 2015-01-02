<!-- shared.top-nav -->
    <button class="btn navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <nav class="navbar-collapse collapse">
        <ul class="nav nav-pills">
            <?php $pages = Page::getMenu(); ?>
          @foreach($top_links as $key => $static_menu_item)
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
    </nav>