@if (Session::has('message'))
    <div class="alert alert-{{ Session::get('type', 'success') }}">
        {{ Session::get('message') }}
    </div>
@endif