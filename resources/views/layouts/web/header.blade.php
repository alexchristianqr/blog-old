<header id="header">
    <h1><a href="{{ url('/') }}">Alex Christian</a></h1>
    <nav class="links">
        <ul>
            <li><a class="icon-fa-facebook" href="#"><i class="fa fa-facebook-square fa-2x"></i></a></li>
            <li><a class="icon-fa-google" href="#"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
            <li><a class="icon-fa-twiter" href="#"><i class="fa fa-twitter-square fa-2x"></i></a></li>
            <li><a class="icon-fa-github" href="#"><i class="fa fa-github-square fa-2x"></i></a></li>
            <li><a class="icon-fa-linkedin" href="#"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
        </ul>
    </nav>
    <nav class="main">
        <ul>
            <li class="search">
                <a class="fa-search" href="#search">Search</a>
                <form id="search" method="GET" action="{{ url('search') }}">
                    <input type="text" name="query" placeholder="Buscar" />
                </form>
            </li>
            <li class="menu">
                <a class="fa-bars" href="#menu">Menu</a>
            </li>
        </ul>
    </nav>
</header>