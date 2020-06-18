@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
	<table class="table table-hover table-striped table-condensed">
		<thead>
		<tr>
			<th>Title</th>
			<th>Published</th>
			<th>Edit</th>
		</tr>
		</thead>
		<tbody>
			@foreach($posts as $post)
				<tr>
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
						   href="/blog/{{$post->id}}/edit">
							edit
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a class="btn btn-success" href="/blog/create">create post</a>
</div>
@stop