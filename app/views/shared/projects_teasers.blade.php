<?php if(empty($project->image)) { $image = 'project3.jpg'; } else { $image = $project->image; } ?>
<div class="media row">
  <img class="media-object col-lg-4" src="/img/projects/{{$image}}" alt="{{{$project->title}}}">
  <br>
  <div class="media-body">
    <h4 class="media-heading">{{{$project->title}}}</h4>
    <div class="row">
      <div class="col-lg-12">
        {{{$project->city_county}}}
        <br>
        {{{$project->state_country}}}
      </div>
    </div>
    <p>{{$project->body}}</p>
    <div><a href="{{$project->slug}}">read more...</a></div>
  </div>
</div>