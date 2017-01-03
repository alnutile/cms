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
					@if(!empty($menu['children']))
						<ol>
							 <?php sub_menus($menu['children'])?>
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
<?php 
function sub_menus($sub_menu)
{
	 foreach($sub_menu as $child)
	 { ?>
		<li data-name="{{$child['title']}}" data-page-id="{{$child['id']}}" data-page-menu-parent="{{$child['menu_parent']}}" data-menu-location="{{$child['menu_name']}}"> <i class="glyphicon glyphicon-move"></i><?php echo $child['title'];
		if(count($child['children'])>0)
		{
			echo "<ol>";
			sub_menus($child['children']);
			echo "</ol>";
		}
		else
		{
			echo "<ol></ol>";
		}
		echo '</li>';
     }
}
?>