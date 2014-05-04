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
                <li class="active"><a href="/pages">Admin Pages</a></li>
                <li class="active"><a href="/users">Admin Users</a></li>
                <li><a href="#">Admin Portfolios</a></li>
                <li><a href="#">Admin Banners</a></li>
                <li><a href="#">Admin Menu</a></li>
                @if(Auth::check())
                    <li>{{ HTML::link('users/' . Auth::user()->id .  '/edit', 'Profile') }}</li>
                    <li>{{ HTML::link('logout', 'Logout') }}</li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>