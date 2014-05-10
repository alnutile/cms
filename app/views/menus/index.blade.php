@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content dragging">
    <h3>Drag and drop to manage your <strong>Top Right Menu</strong></strong></h3>

            <ol class="top-menu">
            @foreach($menus as $menu)

                <li
                    data-name="{{$menu->title}}"
                    data-page-id="{{$menu->id}}"
                    data-page-menu-parent="{{$menu->menu_parent}}"
                    data-menu-location="{{$menu->menu_name}}">
                    <i class="glyphicon glyphicon-move">

                    </i>&nbsp;{{$menu->title}} {{$menu->slug}}
                </li>
            @endforeach
            </ol>
            <button type="button" class="btn btn-success" id="top-button">save</button>
</div>
@stop