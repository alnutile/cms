@if (Session::has('message'))
<div class="alert alert-{{ Session::get('type') }}">{{ Session::get('message') }}</div>
@endif