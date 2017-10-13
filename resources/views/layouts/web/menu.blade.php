<section id="menu">

    <!-- Search -->
    <section>
        <form id="search" method="GET" action="{{ url('search') }}">
            <input type="text" name="query" placeholder="buscar" maxlength="25" required/>
        </form>
    </section>

    <!-- Links -->
    <section>
        <ul id="side-menu" class="nav links">
            <li class="href">
                <a href="{{ url('/') }}">
                    <h3>Blog</h3>
                    <p>aprender mas y mas</p>
                </a>
            </li>
            <li class="href">
                <a href="{{ url('portfolio') }}">
                    <h3>Portafolio</h3>
                    <p>proyectos de software</p>
                </a>
            </li>
            <li class="href">
                <a href="{{ url('profile') }}">
                    <h3>Perfil</h3>
                    <p>sobre mi, pasatiempos, gustos y mas</p>
                </a>
            </li>
            <li class="href">
                <a href="{{ url('service') }}">
                    <h3>Servicio</h3>
                    <p>conocimiento y linea de trabajo</p>
                </a>
            </li>
            <li class="href">
                <a href="{{ url('contact/') }}">
                    <h3>Contacto</h3>
                    <p>posicion de encuentro</p>
                </a>
            </li>

        </ul>
    </section>

    <!-- Actions -->
    <section>
        <ul class="actions vertical">
            <li>
                <a title="unirme al equipo" href="{{ url('login') }}" class="button button-main big fit">Join Team</a>
            </li>
        </ul>
    </section>

</section>