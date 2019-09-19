@if($settings->logo && $settings->theme == true)
<a class = "side_logo" href="/">{{ HTML::image("/img/settings/{$settings->logo}", $settings->name)}}</a>
@endif
<ul class="nav nav-list">
@if(isset($top_left_nav))
  @foreach($top_left_nav as $item)
    <li class="{{Request::url() ==  URL::to($item['slug']) ? 'active':'not-active'}} dropdown movable">
		<a href="{{URL::to($item['slug'])}}">{{$item['title']}}</a>
		
		<ul class='nav nav-list tags_nav @if(trim($item["title"]) != "Portfolio") hide @endif ' role="menu{{$item['title']}}" style="padding: 20px 0;">
			@if(isset($portfolio_category)) 
			  @foreach($portfolio_category as $category)
				<?php 
					$link = Request::url();
					$link_array = explode('/',$link);
					$page = end($link_array);
				?>
				<li class="@if(strtolower($category['name']) ==  $page )active @else not-active @endif {{strtolower($item['title']).'=='.$page}} == {{ strtolower($category['name']) }}">
				  <a href="{{URL::to('/portfolio_categories'.$category['slug'])}}">{{$category['name']}}</a>
				</li> 
			  @endforeach
			@endif
		</ul>	

    </li>      
  @endforeach
@endif
</ul>
@if(isset($tags))
<div class="border"></div>
<ul class="nav nav-list tags_nav">
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