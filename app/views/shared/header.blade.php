
<?php $banners = Banner::slideShow(); ?>


@if(count($banners) == 0)

<!-- no banners -->

@endif

@if(count($banners) >= 2)

<div class="carousel slide" id="banner-header">
    <ol class="carousel-indicators">
      @foreach($banners as $key => $banner)
        @if($key == 0)
            <!--active class on li needed below-->
            <li class="active" data-slide-to="{{$key}}" data-target="#banner-header"></li>
        @else
            <!--active class on li needed below-->
            <li data-slide-to="{{$key}}" data-target="#banner-header"></li>
        @endif
      @endforeach
    </ol>

    <div class="carousel-inner">
        @foreach($banners as $key => $banner)
            @if($key == 0)
                <div class="item active"> <!--active on div needed on the one-->
                    <img alt="" src="/img/banners/{{$banner->banner_name}}" />
                </div>
            @else
                <div class="item"> <!--active on div needed on the one-->
                    <img alt="" src="/img/banners/{{$banner->banner_name}}" />
                </div>
            @endif
        @endforeach
    </div>

    @foreach($banners as $key => $banner)
        @if($key == 0)
            <a class="left carousel-control" href="#banner-header" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
        @else
           <a class="right carousel-control" href="#banner-header" data-slide="next">
               <span class="glyphicon glyphicon-chevron-right"></span>
           </a>
        @endif
    @endforeach
</div>
@else
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column home-banner-wrapper">
            <img class="home-banner" src="/img/banners/{{$banner->banner_name}}" />
        </div>
    </div>
</div>
@endif
