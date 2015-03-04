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
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><a href="/about">Our Company</a></td>
            <td><a id="page-id-2" href="/pages/2/edit">edit</a></td>
        </tr>
        <tr>
            <td><a href="/our_Process">Our Process</a></td>
            <td><a id="page-id-5" href="/pages/5/edit">edit</a></td>
        </tr>
        <tr>
            <td><a href="/testimonials">Testimonials</a></td>
            <td><a id="page-id-6" href="/pages/6/edit">edit</a></td>
        </tr>
        <tr>
            <td><a href="/posts">Portfolio</a></td>
            <td><a id="page-id-7" href="/admin/projects">edit</a></td>
        </tr>
        <tr>
            <td><a href="/news_awards">News &amp; Awards</a></td>
            <td><a id="page-id-7" href="/pages/7/edit">edit</a></td>
        </tr>
        <tr>
            <td><a href="/posts">Builder's Notebook</a></td>
        </tr>
        <tr>
            <td><a href="/contact">Contact Page</a></td>
            <td><a id="page-id-3" href="/pages/3/edit">edit</a></td>
        </tr>

        </tbody>
    </table>

</div>
@stop