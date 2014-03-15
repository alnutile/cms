@if ( Session::get('error') )
    <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
    @endif

    @if ( Session::get('notice') )
    <div class="alert alert-success">{{{ Session::get('notice') }}}</div>
@endif