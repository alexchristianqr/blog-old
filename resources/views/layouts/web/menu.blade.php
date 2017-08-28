<section id="menu">

    <!-- Search -->
    <section>
        <form class="search" method="get" action="#">
            <input type="text" name="query" placeholder="Search"/>
        </form>
    </section>

    <!-- Links -->
    <section>
        <ul class="links">
            <li>
                <a href="{{ url('personal/profile') }}">
                    <h3>Perfil</h3>
                    <p>saber un poco de mi, logros, retos, objetivo del blog.</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}">
                    <h3>Blog</h3>
                    <p>bitacora de registros informativos para aprender</p>
                </a>
            </li>
            <li>
                <a href="{{ url('personal/service') }}">
                    <h3>Servicios</h3>
                    <p>proyectos de software y frelancer.</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Contácto</h3>
                    <p>ubicacion de mi persona.</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Portafolio</h3>
                    <p>bitácora de proyectos participados y logrados por fechas.</p>
                </a>
            </li>
        </ul>
    </section>

    <!-- Actions -->
    <section>
        <ul class="actions vertical">
            <li>
                <a href="{{ url('login') }}" class="button big fit">Iniciar Sesión</a><br>
            </li>
        </ul>
    </section>

</section>