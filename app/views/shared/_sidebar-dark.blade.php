@if($settings->logo && $settings->theme == true && $settings->enable_top_nav_dark == 0)
<a class = "side_logo" href="/">{{ HTML::image("/img/settings/{$settings->logo}", $settings->name)}}</a>
@endif
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
<ul class="nav nav-list dark" id="dark">
@if(isset($top_left_nav))
  @foreach($top_left_nav as $item)
	<?php $submenu = []; $sub_menu = [];?>
	@if( isset($item['menu_parent']) && $item['menu_parent'] == 0 )
		<?php
			$portfolio_category_id_list = explode(",", $item['portfolio_category_id']);
			$submenu = DB::table('portfolio_category') ->whereIn('id', $portfolio_category_id_list)->where('is_active', 1)->select('id','slug','name')->orderBy('sort_order', 'asc')->get();
			$sub_menu = DB::select('select * from pages where menu_parent = ?', array($item['id']));
		?>
	@endif
    <li class="{{('/'.$page_slug ==  $item['slug'] || $page_slug == trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )) ? 'active':'not-active'}} @if( count($submenu) > 0 || count($sub_menu) > 0 ) dropdown @endif" >
		<a 
			@if( count($submenu) > 0 || count($sub_menu) > 0 )
				data-toggle="collapse" data-target=".{{trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )}}"
			@else
				href="{{URL::to($item['slug'])}}"
			@endif
			class="pull-right" >
				@if( count($submenu) > 0 || count($sub_menu) > 0 ) 
					<span>  <i class="fa fa-angle-down"></i></span>
				@endif 
				<span>{{$item['title']}}&nbsp;&nbsp;&nbsp;</span>
			</a>		
		@if($settings->theme == true)				
			@if(isset($submenu))
						
				@if(sizeof($submenu) != 0)						
					<ul class="pull-right nav nav-list tags_nav collapse {{('/'.$page_slug ==  $item['slug'] || $page_slug == trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )) ? 'in' : ''}} {{trim(preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']))}}" style="padding: 0;">
						<li class="{{ '/'.$page_for_submenu1 == $item['slug'] ? 'active' : 'not-active' }}" ><a href="{{URL::to($item['slug'])}}" style="margin: 11px 0px 0px 20px;" class="pull-right">{{$item['title']}}</a></li>
						@foreach($submenu as $menu)
							<li class="@if('/'.$page_slug ==  $item['slug'] || $page_slug == trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )) {{ '/'.$cat_slug == $menu->slug ? 'active' : 'not-active' }} @else not-active @endif" ><a href="{{URL::to($menu->slug)}}"  class="pull-right">{{$menu->name}}</a></li>					
						@endforeach
					</ul>
				@endif
			@endif			
			
			@if(sizeof($sub_menu) != 0 )
				
				@if(isset($sub_menu))
									
					@if(sizeof($sub_menu) != 0)
						<ul class="pull-right nav nav-list tags_nav collapse {{('/'.$page_slug ==  $item['slug'] || $page_slug == trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )) ? 'in' : ''}} {{trim(preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']))}}" style="padding: 0;">
							@if(sizeof($submenu) == 0)
								<li class="{{ '/'.$page_for_submenu1 == $item['slug'] ? 'active' : 'not-active' }}" ><a href="{{URL::to($item['slug'])}}" style="margin: 11px 0px 0px 20px;" class="pull-right">{{$item['title']}}</a></li>
							@endif
							@foreach($sub_menu as $menu)
								<li class="{{ '/'.$page_for_submenu1 == $menu->slug ? 'active' : 'not-active' }}" ><a href="{{URL::to($menu->slug)}}" style="margin: 11px 0px 0px 20px;" class="pull-right">{{$menu->title}}</a></li>					
							@endforeach
						</ul>
					@endif
				@endif			
			@endif
		@endif
	</li>      
  @endforeach
@endif
</ul>
@if(isset($tags))
<div class="border"></div>
<ul class="nav nav-list tags_nav second_tags_nav">
    @foreach($tags as $tag)
      @if(!empty($tag['tag']))
		<?php $current_url = $tag['tagable_type'].'/tags/'.$tag['tag'];?>
		<li class="{{urldecode(Request::url()) ==  URL::to($current_url) ? 'active' : 'not-active' }}">
    	<a href="/{{$tag['tagable_type']}}/tags/{{$tag['tag']}}">{{$tag['tag']}}</a></li>
      @endif
    @endforeach
</ul>
@endif
<!-- Removed from end of parenthesis: || $settings->menu_name == 'sub_nav' -->
<!-- 
@if(isset($sub_nav))
<div class="border"></div>
<ul class="nav nav-list tags_nav">
    @foreach($sub_nav as $sub_nav_item)
    <li class="{{ Request::url() ==  URL::to($sub_nav_item['slug']) ? 'active' :'not-active'}}">
      <a href="{{URL::to($sub_nav_item['slug'])}}">{{$sub_nav_item['title']}}</a>
    </li>
    @endforeach
</ul>
@endif
-->


@if($settings->theme == false)
@include('shared._social')
@endif