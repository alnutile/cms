<!-- shared.top-nav -->
<button class="btn navbar-toggle" data-toggle="collapse" data-target="#nav-collapse-top">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>

<nav class="navbar-collapse collapse" id="nav-collapse-top">
    <ul class="nav nav-pills">
      @foreach($top_left_nav as $top)
      <li>
      <a href="{{URL::to($top->slug)}}">{{$top->title}}</a>
      </li>
      @endforeach
       
    </ul>
</nav>