<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">CMS</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=<?php if(Request::path() == 'pages') { echo 'active'; }?>><a href="/pages">Admin Pages</a></li>
                <li class=<?php if(Request::path() == 'portfolios') { echo 'active'; }?>><a href="/admin/portfolios">Admin Portfolios</a></li>
                @if(Auth::user()->admin == 1)
                  <li class=<?php if(Request::path() == 'users') { echo 'active'; }?>><a href="/users">Admin Users</a></li>
                @endif
                <li class=<?php if(Request::path() == 'banners') { echo 'active'; }?>><a href="/banners">Admin Banners</a></li>
                @if(Auth::user()->admin == 1)
                    <li class=<?php if(Request::path() == 'settings') { echo 'active'; }?>><a href="/settings/1/edit">Admin Settings</a></li>
                @endif
                <li class=<?php if(Request::path() == 'menu') { echo 'active'; }?>><a href="/menus">Admin Menu</a></li>
                @if(Auth::check())
                    <li class=<?php if(Request::path() == 'users/' . Auth::user()->id .  '/edit') { echo 'active'; }?>>{{ HTML::link('users/' . Auth::user()->id .  '/edit', 'Profile') }}</li>
                    <li>{{ HTML::link('logout', 'Logout') }}</li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>