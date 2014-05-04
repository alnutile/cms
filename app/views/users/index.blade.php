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
            <th>Email</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                @if(Auth::user()->id == 1 || $user->id == Auth::user()->id)
                    <tr>
                        <td><a href="/users/{{$user->id}}/edit">{{$user->firstname}} {{$user->lastname}}</a></td>
                        <td><a href="/users/{{$user->id}}/edit">{{$user->email}}</a></td>
                        <td><a href="/users/{{$user->id}}/edit">edit</a></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
[[add user]]
@stop