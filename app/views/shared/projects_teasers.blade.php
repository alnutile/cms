
<?php if(empty($project->image)) {
    $image = 'project3.jpg';
} else
{ $image = $project->image; }
?>

{{--new way--}}
@if($project->thumbs->url())
            <?php $image = $project->thumbs->url('grid')?>
{{--for old way with no image resizing--}}
@elseif($project->image)
            <?php $image = '/' . $path . '/' . $project->image; ?>
@endif

<div class="media row">
    <a href="{{$project->slug}}" alt="{{$project->title}}">
  <img class="media-object col-md-4 col-xs-12" src="{{$image}}" alt="{{{$project->title}}}">
    </a>
    <div class="clearfix-sm foo"></div>
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