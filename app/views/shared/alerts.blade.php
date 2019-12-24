@if (Session::has('message'))
    <div class="alert alert-{{ Session::get('type', 'success') }}">
        {{ Session::get('message') }}
    </div>
	{{Session::put('message' , '').Session::put('type' , '')}}
@endif