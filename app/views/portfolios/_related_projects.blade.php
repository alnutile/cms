<div class="well sidebar-nav">

    <ul class="nav nav-list">
        @if($settings->theme == false)
        <li class="nav-header">
            <i class="glyphicon glyphicon-th"></i>
            &nbsp; Related Projects
        </li>
        @endif
        @foreach($portfolio->projects as $p)
            <li>
                <a href="/projects/{{$p->id}}/edit">{{$p->title}}</a>
            </li>
        @endforeach
    </ul>
    <div class="help-block" style="padding: 10px;">
        <p>You can see related Projects above. Just click to edit them</p>
    </div>
</div>