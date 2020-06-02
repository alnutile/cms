@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content">
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>Name</th>
			<th>Sort Order</th>
            <th>Is Active?</th>
            <th>Slug</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
					<td>{{$category->sort_order}}</td>
                    <td>{{$category->is_active}}</td>
                    <td>{{$category->slug}}</td>
                    <td>
                        <a id="category-id-{{$category->id}}"
                           href="{{url('/portfolio_categories/'.$category->id.'/edit')}}">
                            edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="{{url('/portfolio_categories/create')}}">Create</a>
</div>
@stop