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
            if (Request::server('PATH_INFO') == $static_menu_item) {
                $active = 'active';
            }
            else {
                $active = 'not-active';
            }
            ?>
            @if($key == 'Portfolios' && !empty($portfolio_links))
                <li class="{{$active}} dropdown">
                    <a class="dropdown-toggle"
                        data-toggle="dropdown"
                        href="#">
                        Portfolios
                    </a>

                    <ul class="dropdown-menu">
                        @foreach($portfolio_links as $key => $portfolio)
                            <li class="{{$active}}">
                                <a href= {{$portfolio}}>{{$key}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @elseif($key != 'Portfolios')
                <li class="{{$active}}">
                    <a href= {{$static_menu_item}}>{{$key}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>