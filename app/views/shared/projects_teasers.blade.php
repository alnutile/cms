

{{--new way--}}
@if($project->thumbs->url('grid') != '/thumbs/grid/missing.png')
            <?php $image = $project->thumbs->url('grid');?>
{{--for old way with no image resizing--}}
@elseif($project->image)
            <?php $image = '/img/projects/' . $project->image; ?>
@else   <?php $image = null; ?>
@endif

<div class="media row">
	@if(strpos($image, 'Blank') !== false)
	@else
		@if($image && file_exists(public_path($image)))
			<div class="col-xs-12 col-md-4 project_block d">
				<a href="{{$project->slug}}" alt="{{$project->title}}">
					<div class="proj_img">
						<img class="img-responsive" src="{{$image}}" alt="{{{$project->title}}}">
						<div class="project_grid_title" >{{{$project->title}}} </div>
					</div>
				</a>
			</div>	
		<div class="clearfix-sm"></div>
		@endif
	@endif
	<br>

  <div class="media-body padding-lr">
    <a href="{{$project->slug}}"><h4 class="media-heading">{{{$project->title}}}</h4></a>
    <div class="row">
      <div class="col-lg-12">
        {{{$project->city_county}}}
        <br>
        {{{$project->state_country}}}
      </div>
    </div>	
		<p>
			<?php $teaser = strip_tags(Str::words($project->body, 50)); ?>
			{{$teaser}}
		</p>
		<div><a href="{{$project->slug}}">read more...</a></div>	
  </div>

</div>