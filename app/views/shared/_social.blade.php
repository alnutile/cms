<div id="social">
    <ul class="text-center list-inline">
        @if($settings->facebook)
        <li>
            <a href="{{$settings->facebook}}">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        @endif
        @if($settings->linkedin)
        <li>
            <a href="{{$settings->linkedin}}">
                <i class="fa fa-linkedin"></i>
            </a>
        </li>
        @endif
        @if($settings->twitter)
        <li>
            <a href="{{$settings->twitter}}">
                <i class="fa fa-twitter"></i>
            </a>
        </li>
        @endif
        @if($settings->pinterest)
        <li>
            <a href="{{$settings->pinterest}}">
                <i class="fa fa-pinterest"></i>
            </a>
        </li>
        @endif
        @if($settings->gplus)
        <li>
            <a href="{{$settings->gplus}}">
                <i class="fa fa-google-plus"></i>
            </a>
        </li>
        @endif
    </ul>
</div>