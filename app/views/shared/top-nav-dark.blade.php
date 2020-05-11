<!-- shared.top-nav -->
<button class="btn navbar-toggle" data-toggle="collapse" data-target="#nav-collapse-top">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
<?php
$link_for_submenu = $_SERVER['PHP_SELF'];
$link_array_for_submenu = explode('/',$link_for_submenu);
$page_for_submenu = strtolower(str_replace('_', ' ',end($link_array_for_submenu)));
$page_for_submenu1 = Request::segment(1);
$page_for_submenu2 = Request::segment(2);
if(!isset($page_slug))
	$page_slug = $page_for_submenu1;	
if(!isset($cat_slug))
	$cat_slug = '';
?>
<nav class="navbar-collapse collapse" id="nav-collapse-top">
    <ul class="nav nav-pills">
	@if(isset($top_left_nav))
		@foreach($top_left_nav as $item)
			<?php $submenu = []; $sub_menu = [];?>
			@if( isset($item['menu_parent']) && $item['menu_parent'] == 0 )
				<?php
					$portfolio_category_id_list = explode(",", $item['portfolio_category_id']);
					$submenu = DB::table('portfolio_category') ->whereIn('id', $portfolio_category_id_list)->where('is_active', 1)->select('id','slug','name')->get();
					$sub_menu = DB::select('select * from pages where menu_parent = ?', array($item['id']));
				?>
			@endif
			<li class="{{('/'.$page_slug ==  $item['slug'] || $page_slug == trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )) ? 'active':'not-active'}} @if( count($submenu) > 0 || count($sub_menu) > 0 ) dropdown @endif" >
				<a @if( count($submenu) > 0 || count($sub_menu) > 0 ) data-toggle="dropdown" class="dropdown-toggle
				@else href="{{URL::to($item['slug'])}}" @endif">{{$item['title']}} @if( count($submenu) > 0 || count($sub_menu) > 0 ) <span class="caret"></span> @endif</a>
				@if(isset($submenu))
					@if(sizeof($submenu) != 0)						
						<ul class="dropdown-menu">
							<li class="{{ '/'.$page_for_submenu1 == $item['slug'] ? 'active' : 'not-active' }}" ><a href="{{URL::to($item['slug'])}}" >{{$item['title']}}</a></li>
							@foreach($submenu as $menu)
								<li class="@if('/'.$page_slug ==  $item['slug'] || $page_slug == trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )) {{ '/'.$cat_slug == $menu->slug ? 'active' : 'not-active' }} @else not-active @endif" ><a href="{{URL::to($menu->slug)}}">{{$menu->name}}</a></li>					
							@endforeach
						</ul>
					@endif
				@endif			
			
			@if(sizeof($sub_menu) != 0 )
				@if(isset($sub_menu))
					@if(sizeof($sub_menu) != 0)
						<ul class="dropdown-menu">
							@if(sizeof($submenu) == 0)
								<li class="{{ '/'.$page_for_submenu1 == $item['slug'] ? 'active' : 'not-active' }}" ><a href="{{URL::to($item['slug'])}}">{{$item['title']}}</a></li>
							@endif
							@foreach($sub_menu as $menu)
								<li class="{{ '/'.$page_for_submenu1 == $menu->slug ? 'active' : 'not-active' }}" ><a href="{{URL::to($menu->slug)}}" >{{$menu->title}}</a></li>					
							@endforeach
						</ul>
					@endif
				@endif			
			@endif
			</li>
		@endforeach
	@endif
	</ul>
	
</nav>
