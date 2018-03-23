<nav class="navbar navbar-expand-md">
    <img class='mr-3' src='/images/cost.png' id='logo' alt='Cost Calculator Logo'>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul>
            @foreach(config('app.nav') as $link => $label)
                <li><a href='{{ $link }}' class='{{ Request::is(substr($link, 1)) ? 'active' : '' }}'>{{ $label }}</a>
            @endforeach
        </ul>
    </div>
</nav>