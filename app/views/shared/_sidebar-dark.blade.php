@if($settings->logo && $settings->theme == true)
<a class = "side_logo" href="/">{{ HTML::image("/img/settings/{$settings->logo}", $settings->name)}}</a>
@endif
<ul class="nav nav-list">
  @if(isset($top_left_nav))
  @foreach($top_left_nav as $item)
    <li class="active"> <a href="{{URL::to($item->slug)}}">{{$item->title}}</a></li>
  @endforeach
  @endif
    </ul>
 @if(isset($tags))
<div class="border"></div>
<ul class="nav nav-list tags_nav">
    @foreach($tags as $tag)
	<?php
	if (!empty($tag['tag'])) { ?>
    	<li><a href="/{{$tag['tagable_type']}}/tags/<?php echo (($tag['tag'])) ?>">{{$tag['tag']}}</a></li>
    <?php } ?>	
    @endforeach
</ul>
@endif
<!-- Removed from end of parenthesis: || $settings->menu_name == 'sub_nav' -->
@if(isset($sub_nav))
<div class="border"></div>
<ul class="nav nav-list tags_nav">
    @foreach($sub_nav as $sub_nav_item)
    <li><a href="{{URL::to($sub_nav_item->slug)}}">{{$sub_nav_item->title}}</a></li>
    @endforeach
</ul>
@endif 



@if($settings->theme == false)
@include('shared._social')
@endif