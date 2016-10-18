<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default well sidebar-nav">

        <?php
        if(Request::server('PATH_INFO') == '/portfolios') {
            $icon = '<i class="glyphicon glyphicon-th">&nbsp;</i>';
        } else {
            $icon = '';
        }
        ?>

        <?php
        if(Request::server('PATH_INFO') ==  '/') {
            $active = 'active';
        } else {
            $active = 'not-active';
        }
        ?>
          @foreach($top_left_nav as $top)
            <!-- check if item is portfolio-->
            @if(isset($top['is_portfolio']))
                <div class="panel-heading" role="tab" id="headingOne">
                  <a href="#"></a>
                  <h4 class="panel-title nav-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <a href="#"><big></big></a><big><a href="#">Portfolios</a></big>
                  </h4>
                </div>
				<?php $search = '/'.Request::path();?>
				@if(in_array_r($search,$portfolio_links,true))
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" style="height: auto;">
				@else
					 <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height: 0px;">
				@endif
                  <div class="panel-body">
                    <ul class="nav nav-list">
                          @foreach($portfolio_links as $key => $portfolio)
                          <li class='{{Request::url() ==  URL::to($portfolio) ? "active" : "not-active" }}'>
                            <a href = {{$portfolio}}>{{$key}}</a>
                          </li>
                          @endforeach
                    </ul>
                  </div>
                </div>
			@elseif(isset($top['is_blog']) && isset($post_tags))
				<div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title nav-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <big>
						<a href="#">{{$top['title']}}</a>
					</big>
                  </h4>
                </div>
				@if(Request::url() ==  URL::to($top['slug']) || strpos(Request::url(), $top['slug']) !== false)
				<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" style="height: auto;">
				@else
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height: 0px;">
				@endif
				  <div class="panel-body">
					<ul class="nav nav-list">
						<li @if(Request::url() ==  URL::to($top['slug'])) class="active" @endif><a href="{{URL::to($top['slug'])}}">{{$top['title']}}</a></li>
						@foreach($post_tags as $tag)
							<?php $current_url = $tag['tagable_type'].'/tags/'.$tag['tag'];?>
							<li @if(urldecode(Request::url()) ==  URL::to($current_url)) class="active" @endif><a href="/{{$tag['tagable_type']}}/tags/{{$tag['tag']}}">{{$tag['tag']}}</a></li>
						@endforeach
					</ul>
				  </div>
				</div>
			@else
                <?php 
					$sub_light = Page::getSubNavSorted($top['id']); 
					$search = '/'.Request::path();
				?>
                @if( count($sub_light) > 1) <!-- start parent with subnav-->    
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <a href="#"></a>
                      <h4 class="panel-title nav-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{$top['id']}}" aria-expanded="true" aria-controls="collapseOne">
                        <a href="#"><big></big></a><big><a href=" ">{{$top['title']}}</a></big>
                      </h4>
                    </div>
					@if(in_array_r($search,$sub_light,true))
						<div id="collapseTwo-{{ $top['id']}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo" style="height: auto;">
					@else
						<div id="collapseTwo-{{ $top['id']}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" style="height: 0px;">
					@endif
                      <div class="panel-body">
                        <ul class="nav nav-list">
                          @foreach($sub_light as $sub)
                          <li  class='{{ Request::url() ==  URL::to($sub["slug"]) ?  "active" : "not-active" }}'>
                            <a href="{{URL::to($sub['slug'])}}">{{$sub['title']}}</a>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    
                @else <!-- parent without subnav-->
                    <div class="panel-heading" role="tab">
                      <h4 class='panel-title nav-header {{ Request::url() ==  URL::to($top["slug"]) ? "active" : "not-active"}}'>    
                          <big> <a href="{{URL::to($top['slug'])}}">{{$top['title']}}</a></big>
                      </h4>
                    </div>
                @endif <!-- end -->  
                            
                
              @endif <!-- end check if item is portfolio-->              
              
          @endforeach

      
    </div>
</div>
<?php 
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}
?>
@include('shared._social')