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
    <li class="{{Request::url() ==  URL::to($item['slug']) ? 'active':'not-active'}} dropdown movable" >
		@if( isset($item['menu_parent']) && $item['menu_parent'] == 0 )
			<?php
				$submenu = [];
				$submenu = DB::select('select * from portfolio_category where id = ?', array($item['portfolio_category_id']));
				$sub_menu = [];
				$sub_menu = DB::select('select * from pages where menu_parent = ?', array($item['id']));
			?>
		@endif
		<a 
		{{ ( ( isset($item['menu_parent']) && $item['menu_parent'] != 0 ) || sizeof($submenu) != 0 ) ? '' : 'href="'.URL::to($item['slug']).'"'}} 
		
		@if( count($submenu) > 0 || count($sub_menu) > 0 )
			data-toggle="collapse" data-target=".{{trim( preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']) )}}"
		@endif
		class="pull-right submenu-cl" 
		size_submenu="{{count($sub_menu)}}" size_portfolio="{{sizeof($submenu)}}" >@if( count($submenu) > 0 || count($sub_menu) > 0 ) <span>  <i class="fa fa-angle-down"></i></span> @endif <span>{{$item['title']}}&nbsp;&nbsp;&nbsp;</span></a>		
		@if($settings->theme == true)				
			@if(isset($submenu))
				@foreach($submenu as $menu1)
					<?php $sub_available_slug[] = strtolower(str_replace('/', '',str_replace('_', ' ',$menu1->slug))); ?>
				@endforeach				
				@if(sizeof($submenu) != 0)						
					<ul class="pull-right nav nav-list tags_nav collapse {{trim(preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']))}}" style="padding: 0;">
						<li class="" ><a href="{{URL::to($item['slug'])}}" style="margin: 11px 0px 0px 20px;" class="pull-right">{{$item['title']}}</a></li>
						@foreach($submenu as $menu)
							<li class="{{ $page_for_submenu == strtolower(str_replace('/', '',str_replace('_', ' ', $menu->slug))) ? 'active' : 'not-active' }} portfolio_category1" ><a href="{{URL::to('/portfolio_categories'.$menu->slug)}}?id={{$menu->id}}"  class="pull-right">{{$menu->name}}</a></li>					
						@endforeach
					</ul>
				@endif
			@endif			
			
			@if(sizeof($sub_menu) != 0 )
				
				@if(isset($sub_menu))
					@foreach($sub_menu as $menu1)
						<?php $sub_available_slug[] = strtolower(str_replace('/', '',str_replace('_', ' ',$menu1->slug))); ?>
					@endforeach					
					@if(sizeof($sub_menu) != 0)
						<ul class="pull-right nav nav-list tags_nav collapse {{trim(preg_replace('/[^A-Za-z0-9 ]/', '', $item['slug']))}}" style="padding: 0;">
							<li class="" ><a href="{{URL::to($item['slug'])}}" style="margin: 11px 0px 0px 20px;" class="pull-right">{{$item['title']}}</a></li>
							@foreach($sub_menu as $menu)
								<li class="{{ $page_for_submenu == strtolower(str_replace('/', '',str_replace('_', ' ', $menu->slug))) ? 'active' : 'not-active' }}" ><a href="{{URL::to($menu->slug)}}" style="margin: 11px 0px 0px 20px;" class="pull-right">{{$menu->title}}</a></li>					
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