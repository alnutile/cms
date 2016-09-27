@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
	<div class="dragging">
		<table class="table table-hover table-striped table-condensed table-sortable">
			<thead>
			<tr>
				<th>Title</th>
				<th>Published</th>
				<th>Edit</th>
			</tr>
			</thead>
			<tbody>
				@foreach($posts as $post)
					<tr data-sort-order="{{$post->order}}" data-post-id="{{$post->id}}">
						<td><a href="{{$post->slug}}">{{{$post->title}}}</a></td>
						<td class="published">
							@if($post->published)
							Published
							@else
							Unpublished
							@endif
						</td>
						<td>
							<a id="post-id-{{$post->id}}"
							   href="/posts/{{$post->id}}/edit">
								edit
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
    <a class="btn btn-success" href="/posts/create">create post</a>
	<button type="button" class="btn btn-success" id="sort-button">save</button>
</div>
@stop