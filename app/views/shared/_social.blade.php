<?php $s = Setting::find(1); ?>
<div id="social">
    <ul class="text-center list-inline">
        <li>
            <a href="{{$s->facebook}}">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li>
            <a href="{{$s->linkedin}}">
                <i class="fa fa-linkedin"></i>
            </a>
        </li>
        <li>
            <a href="{{$s->twitter}}">
                <i class="fa fa-twitter"></i>
            </a>
        </li>
        <li>
            <a href="{{$s->pinterest}}">
                <i class="fa fa-pinterest"></i>
            </a>
        </li>
        <li>
            <a href="{{$s->glus}}">
                <i class="fa fa-google-plus"></i>
            </a>
        </li>
    </ul>
</div>