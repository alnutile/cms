@if($settings->logo && $settings->theme == true)
<a class = "side_logo" href="/">{{ HTML::image("/img/settings/{$settings->logo}", $settings->name)}}</a>
@endif
<?php
$link_for_submenu = $_SERVER['PHP_SELF'];
$link_array_for_submenu = explode('/',$link_for_submenu);
$page_for_submenu = strtolower(str_replace('_', ' ',end($link_array_for_submenu)));
$sub_available_slug = [];
?>

<ul class="nav nav-list dark" id="dark">
@if(isset($top_left_nav))
  @foreach($top_left_nav as $item)
    <li class="{{Request::url() ==  URL::to($item['slug']) ? 'active':'not-active'}} dropdown movable">
		@if( isset($item['menu_parent']) && $item['menu_parent'] == 0 )
			<?php
				$submenu = [];
				$submenu = DB::select('select * from portfolio_category where id = ?', array($item['portfolio_category_id']));			
			?>
		@endif
		<a style="@if(sizeof($submenu) > 0) float: right; @endif">
			
			@if(isset($item['portfolio_category_id']) && $item['portfolio_category_id'] != 0) 
				<span data-toggle="collapse" data-target=".{{trim(preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']))}}" class="@if(isset($item['portfolio_category_id']) && ($item['portfolio_category_id'] == 0 || $item['portfolio_category_id'] == '')) hide @endif" sizeof="{{sizeof($submenu)}}" > 
					@if( $page_for_submenu != strtolower(str_replace('/', '',str_replace('_', ' ', $item['slug'])))) 
						<i class="fa fa-caret-down"></i> 
					@else<i class="fa fa-caret-down"></i> 
					@endif
				</span> 
			@endif 
			<a href="{{URL::to($item['slug'])}}" style="@if(sizeof($submenu) > 0) float:right; @else  @endif" ><spam>{{$item['title']}}</spam></a>
		</a>
		@if($settings->theme == true)
			@if( isset($item['menu_parent']) && $item['menu_parent'] == 0 )
				
				@if(isset($submenu))
					@foreach($submenu as $menu1)
						<?php $sub_available_slug[] = strtolower(str_replace('/', '',str_replace('_', ' ',$menu1->slug))); ?>
					@endforeach
					<ul class="nav nav-list tags_nav collapse {{trim(preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']))}} {{sizeof($sub_available_slug).'=='.$page_for_submenu}} @if( $page_for_submenu != strtolower(str_replace('/', '',str_replace('_', ' ', $item['slug']))) || sizeof($sub_available_slug) == 0 ) @if(!in_array($page_for_submenu, $sub_available_slug)) hided @endif @endif" style="padding: 20px 0;margin-top: 20px; ">
						@foreach($submenu as $menu)
							<li class="{{ $page_for_submenu == strtolower(str_replace('/', '',str_replace('_', ' ', $menu->slug))) ? 'active' : 'not-active' }}" ><a href="@if(isset($category) && $category['slug'] != '') {{URL::to('/portfolio_categories'.$category['slug'])}} @endif" style="margin: 11px 0px 0px 20px;">{{$menu->name}}</a></li>					
						@endforeach
					</ul>
				@endif			
			@endif
		@endif
		@if($settings->multiple_portfolio == true)
			@if(isset($item['is_portfolio']) && $item['is_portfolio'])
				<ul class='nav nav-list tags_nav' role="menu{{$item['title']}}" style="padding: 20px 0;">
					@if(isset($portfolio_category)) 
					  @foreach($portfolio_category as $category)
						<?php 
							$link = Request::url();
							$link_array = explode('/',$link);
							$page = end($link_array);
						?>
						<li class="@if(strtolower($category['name']) ==  $page )active @else not-active @endif {{strtolower($item['title']).'=='.$page}} == {{ strtolower($category['name']) }}">
							<a href="{{URL::to('/portfolio_categories'.$category['slug'])}}?id={{$category['id']}}">{{$category['name']}}</a>
						</li> 
					  @endforeach
					@endif
				</ul>
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



@if($settings->theme == false)
@include('shared._social')
@endif