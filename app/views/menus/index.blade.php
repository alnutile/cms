@extends('layouts.main')

@section('content')
<div class="col-md-3">
    @include('shared.sidebar')
</div>
<div class="col-md-9 column content dragging">
    <h3>Drag and drop to manage your <strong>Top Right Menu</strong></h3>

            <ol class="top-menu">
			@foreach($menus as $menu)
				<li
                    data-name="{{$menu['title']}}"
                    data-page-id="{{$menu['id']}}"
                    data-page-menu-parent="{{$menu['menu_parent']}}"
                    data-menu-location="{{$menu['menu_name']}}">
                    <i class="glyphicon glyphicon-move"></i>&nbsp;{{$menu['title']}}
					@if(array_key_exists('sub_menus', $menu))
						<ol>
							@foreach($menu['sub_menus'] as $sub_menu)
							 <li
								 data-name="{{$sub_menu['title']}}"
								data-page-id="{{$sub_menu['id']}}"
								data-page-menu-parent="{{$menu['id']}}"
								data-menu-location="{{$sub_menu['menu_name']}}">
								<i class="glyphicon glyphicon-move"></i>&nbsp;{{$sub_menu['title']}}
							</li>
							@endforeach
						</ol>
					@else
						<ol></ol>
					@endif
                </li>
            @endforeach
            </ol>
            <button type="button" class="btn btn-success" id="top-button">save</button>
</div>
@stop
