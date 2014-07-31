
    <button class="btn navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <nav class="navbar-collapse collapse">
        <ul class="nav nav-pills">
            <?php $pages = Page::getMenu(); ?>
            @foreach($pages as $page)
                <?php ('/' . Request::path() === $page->slug || Request::path() == '/' && $page->slug == '/home' ) ? $active = 'active' : $active = 'not-active';?>
                <li class="{{$active}}">
                    <a href="{{$page->slug}}">
                        {{{$page->title}}}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>