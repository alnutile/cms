<?php if(empty($project->image)) { $image = 'project3.jpg'; } else { $image = $project->image; } ?>
<div class="media">
  <img class="media-object col-lg-4" src="/img/projects/{{$image}}" alt="{{$project->title}}">
  <div class="media-body">
    <h4 class="media-heading">{{$project->title}}</h4>
    <p>{{$project->body}}</p>
    <div><a href="{{$project->slug}}">read more...</a></div>
  </div>
</div>