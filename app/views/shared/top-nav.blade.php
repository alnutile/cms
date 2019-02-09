<!-- shared.top-nav -->
<button class="btn navbar-toggle" data-toggle="collapse" data-target="#nav-collapse-top">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
<?php 
	if($settings->theme == false)
	{
			$top_left_nav = Page::tree();
			if($settings && is_numeric($settings->portfolio_menu_position))
			{
				if($settings && $settings->enable_portfolio){
					$pos = $settings->portfolio_menu_position - 1;
					$portfolio = ['title' => 'Portfolio', 'slug'=>'/portfolio', 'is_portfolio'=>1];

					Helpers\ArrayHelper::insertAt($top_left_nav, $pos, $portfolio);
				}
			}
			if($settings && $settings->enable_blog)
			{
				$pos = $settings->blog_menu_position - 1;
				$blog = ['id'=> -1,'title' => $settings->blog_title, 'slug'=>'/posts', 'is_blog' =>1];
				Helpers\ArrayHelper::insertAt($top_left_nav, $pos, $blog);    
			}
	}
?>
<nav class="navbar-collapse collapse" id="nav-collapse-top">
    <ul class="nav nav-pills">
	@foreach($top_left_nav as $top)
        @if(isset($top['is_portfolio']))
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$settings->portfolio_title}}</a>
          <ul class="dropdown-menu">
            @foreach($portfolio_links as $key => $portfolio)
            <li class="{{Request::url() ==  URL::to($portfolio) ? 'active' : 'not-active' }}">
              <a href= {{$portfolio}}>{{$key}}</a>
            </li>
            @endforeach
          </ul>
        </li>
		@elseif(isset($top['is_blog']) && isset($post_tags))
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$top['title']}}</a>
			<ul class="dropdown-menu">
				<li class="{{Request::url() ==  URL::to($top['slug']) ? 'active' : 'not-active' }}">
					<a href="{{URL::to($top['slug'])}}">{{$top['title']}}</a>
				</li>
				@foreach($post_tags as $tag)
				<?php $current_url = $tag['tagable_type'].'/tags/'.$tag['tag'];?>
				<li class="{{urldecode(Request::url()) ==  URL::to($current_url) ? 'active' : 'not-active' }}">
					<a href="/{{$tag['tagable_type']}}/tags/{{$tag['tag']}}">{{$tag['tag']}}</a>
				</li>
				@endforeach
			</ul>
		 </li>
		@else
		<li class="dropdown @if(Request::url()==URL::to('/')) @if($top['title']=='Home')active @endif @endif">
			@if(isset($top['children']) && !empty($top['children']))
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$top['title']}}</a>
				@if(isset($top['children']) && !empty($top['children']))
					<ul class="dropdown-menu">
						<a class="dropdown-toggle" data-toggle="dropdown" href="{{URL::to($top['slug'])}}">{{$top['title']}}</a>
						 <?php 
							usort($top['children'], function ($item1, $item2) {
								return $item1['menu_sort_order'] >= $item2['menu_sort_order'];
							});
							sub_nav_menus($top['children']);
						 ?>
					</ul>
				@endif
			@else
				<a href="{{URL::to($top['slug'])}}" class="{{Request::url() ==  URL::to($top['slug']) ? 'active' : 'not-active' }}">{{$top['title']}}</a>
			@endif
          </li>
        @endif
      @endforeach       
    </ul>
	
</nav>

<?php 
function sub_nav_menus($sub_menu)
{
	 foreach($sub_menu as $child)
	 { ?>
		<li class="dropdown-submenu {{Request::url() ==  URL::to($child['slug']) ? 'active' : 'not-active' }}">
		<a tabindex="-1" href="{{URL::to($child['slug'])}}"/><?php echo $child['title'];?></a><?php
		if(count($child['children'])>0)
		{
			echo "<ul class='dropdown-menu'>";
			sub_nav_menus($child['children']);
			echo "</ul>";
		}
		echo '</li>';
     }
}
?>
