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
            @foreach($pages as $page)
                <tr>
                    <td><a href="{{$page->slug}}">{{{$page->title}}}</a></td>
                    <td class="published">
                        @if($page->published)
                        Published
                        @else
                        Unpublished
                        @endif
                    </td>
                    <td>
                        <a id="page-id-{{$page->id}}"
                           href="/pages/{{$page->id}}/edit">
                            edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="/pages/create">Create Page</a>
</div>
@stop