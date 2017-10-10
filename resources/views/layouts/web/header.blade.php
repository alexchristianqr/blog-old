<header id="header">
    <h1><a href="{{ url('/') }}">Alex Christian</a></h1>
    <nav class="links">
        <ul class="nav" id="side-menu">
            <li class="href"><a href="{{ url('/') }}"><span>blog</span></a></li>
            <li class="href"><a href="{{ url('portfolio') }}"><span>portafolio</span></a></li>
            <li class="href"><a href="{{ url('service') }}"><span>servicio</span></a></li>
            <li class="href"><a href="{{ url('contact/') }}"><span>contacto</span></a></li>
            <li class="href"><a href="{{ url('profile') }}"><span>perfil</span></a></li>
        </ul>
    </nav>
    <nav class="main">
        <ul>
            <li class="search">
                <a class="fa-search" href="#search">Search</a>
                <form id="search" method="GET" action="{{ url('search') }}">
                    <input type="text" name="query" placeholder="buscar" maxlength="25" required />
                </form>
            </li>
            <li class="menu">
                <a class="fa-bars" href="#menu">Menu</a>
            </li>
        </ul>
    </nav>
</header>