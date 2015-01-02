<div class="row"><div class="span12"><hr></div></div>
<footer>
    <div class="container">
        <div class="row">
            {{$settings->footer}}
        </div>
        <div class="row">
            @if($settings->theme != false)
                @include('shared._social')
            @endif
        </div>
    </div>   <!--//end container -->
</footer>