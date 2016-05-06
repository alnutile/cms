<!-- shared.top-nav -->
<button class="btn navbar-toggle" data-toggle="collapse" data-target="#nav-collapse-top">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>

<nav class="navbar-collapse collapse" id="nav-collapse-top">
    <ul class="nav nav-pills">
      @foreach($top_left_nav as $top)
        @if(isset($top['is_portfolio']))
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Portfolios</a>
          <ul class="dropdown-menu">
            @foreach($portfolio_links as $key => $portfolio)
            <li class="{{Request::url() ==  URL::to($portfolio) ? 'active' : 'not-active' }}">
              <a href= {{$portfolio}}>{{$key}}</a>
            </li>
            @endforeach
          </ul>
        </li>
        @else
        
          <?php $sub_light = Page::getSubNavSorted($top['id']);?>            
          @if( count($sub_light) > 1)
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$top['title']}}</a>
            <ul class="dropdown-menu">
              @foreach($sub_light as $sub)
              <li  class="{{Request::url() ==  URL::to($sub['slug']) ? 'active' : 'not-active'}}">
                <a href="{{URL::to($sub['slug'])}}">{{$sub['title']}}</a>
              </li>
              @endforeach
            </ul>
          </li>
          @else
          <li class="{{ Request::url() ==  URL::to($top['slug']) ? 'active' : 'not-active'}}">
            <a href="{{URL::to($top['slug'])}}">{{$top['title']}}</a>
          </li>
          @endif
        @endif
      @endforeach       
    </ul>
</nav>


