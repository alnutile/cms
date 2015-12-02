@if($settings->logo && $settings->theme == true)
<a class = "side_logo" href="/">{{ HTML::image("/img/settings/{$settings->logo}", $settings->name)}}</a>
@endif
<ul class="nav nav-list">
    <?php
    if(Request::server('PATH_INFO') == '/portfolios') {
        $icon = '<i class="glyphicon glyphicon-th"></i>';
    } else {
        $icon = '';
    }
    ?>
    @if($settings->theme == false)
    <li class="nav-header">
        <h4>{{$icon}}&nbsp;Links</h4>
    </li>
    @endif
    @foreach($shared_links as $key => $static_menu_item)
    <?php
    //if(Request::server('PATH_INFO') ==  $static_menu_item) {
    if($_SERVER['REQUEST_URI'] ==  $static_menu_item) {
        $active = 'active';
    } else {
        $active = 'not-active';
    }
    ?>
    <li class="{{$active}}"> <a href = {{$static_menu_item}}>{{$key}}</a></li>
    @endforeach
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
@if($settings->theme == true && $settings->pageId == 2 || $settings->menu_name == 'sub_nav')
<div class="border"></div>
<ul class="nav nav-list tags_nav">
    <li><a href = "/about">Our Company</a></li>
    <li><a href = "/our_process">Our Process</a></li>
    <li><a href = "/testimonials">Testimonials</a></li>
</ul>
@endif

@if($settings->theme == false)
@include('shared._social')
@endif
