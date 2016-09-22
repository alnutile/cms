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
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height: 0px;">
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
			@elseif(isset($top['is_blog']) && isset($tags))
				<div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title nav-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <big>
						<a href="#">{{$top['title']}}</a>
					</big>
                  </h4>
                </div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height: 0px;">
				  <div class="panel-body">
					<ul class="nav nav-list">
						@foreach($tags as $tag)
							<li><a href="/{{$tag['tagable_type']}}/tags/{{$tag['tag']}}">{{$tag['tag']}}</a></li>
						@endforeach
					</ul>
				  </div>
				</div>
				
			@else
                   
                <?php 
                // if(!isset($top['id'])) { dd($top); };
                
                $sub_light = Page::getSubNavSorted($top['id']); ?>
                          
                @if( count($sub_light) > 1) <!-- start parent with subnav-->    
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <a href="#"></a>
                      <h4 class="panel-title nav-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{$top['id']}}" aria-expanded="true" aria-controls="collapseOne">
                        <a href="#"><big></big></a><big><a href=" ">{{$top['title']}}</a></big>
                      </h4>
                    </div>
                    <div id="collapseTwo-{{ $top['id']}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" style="height: 0px;">
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

@include('shared._social')
