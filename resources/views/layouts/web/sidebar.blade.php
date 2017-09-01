<section id="sidebar">

    <!-- Intro -->
    <section id="intro">
        <div>
            <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/perfil.png')  }}" alt="alex"/></a>
        </div>
        <header>
            <h2>alex christian</h2>
            <p class="p-sidebar-header"><span>ANALISTA PROGRAMADOR FULL-STACK FORMADOR Y CONSULTOR TECNICO</span></p>
        </header>
    </section>

    <!-- Mini Posts -->
    <section>
        <section class="blurb">
            <h2>proximamente</h2>
        </section>
        <div><br></div>
        <div class="mini-posts">
            <!-- Mini Post -->
            @foreach($data_pre_posts as $key => $value)
                @for($i=1;$i<3;$i++)
                <article class="mini-post">
                    <header>
                        <h3><a href="#">{{ $value->title }}</a></h3>
                        <time class="published">
                            <span class="to-lowercase">próxima publicación</span>&nbsp;<b>{{ Jenssegers\Date\Date::parse($value->date_publication)->format('d M Y') }}</b>
                        </time>
                        <a href="#" class="author"><img class="img-profile" src="{{ asset('images/'.$value->user_image) }}" alt=""/></a>
                    </header>
                    <a href="#" class="image">
                        <div class="thumbnail thumbnail-minipost">
                            <img src="{{ asset('images/x351/'.$value->image) }}" alt=""/>
                        </div>
                    </a>
                </article>
            @endfor
            @endforeach
        </div>
        <div class="blurb">
            <p><span>Suscríbete para recibir más información del próximo Curso, Post, Noticia o Novedad a publicarse.</span></p>
            <form action="{{ url('email/suscription') }}" method="GET" id="formSendEmailSuscription">
                <ul class="actions">
                    <li>
                        <input type="email" name="email_suscription" placeholder="E-mail" title="email para la suscripcion" class="form-control" required />
                    </li>
                    <li>
                        <button type="submit" class="button button-href"><i class="fa fa-envelope"></i></button>
                    </li>
                </ul>
            </form>
        </div>
    </section>


    <!-- Posts List -->
    <section>
        <section class="blurb">
            <h2>ultimas novedades</h2>
        </section>
        <div><br></div>
        <ul class="posts">
            @foreach($data_mini_posts as $key => $value)
                <li>
                    <article>
                        <header>
                            <h3><a href="{{ url('post/show',['id' => $value->id_post]) }}">{{ $value->title }}</a></h3>
                            <time class="published" datetime="2015-10-20"><span
                                        class="to-lowercase">publicado el </span>{{ Jenssegers\Date\Date::parse($value->created_at)->format('d F Y') }}
                            </time>
                        </header>
                        <a href="{{ url('post/show',['id' => $value->id_post]) }}" class="image">
                            <div class="thumbnail" style="margin-bottom: 0">
                                <img src="{{ asset('images/x100/' . json_decode($value->images)->x100) }}" alt=""/>
                            </div>
                        </a>
                    </article>
                </li>
            @endforeach
        </ul>
        <ul class="actions">
            <li><a href="#" class="button">saber mas</a></li>
        </ul>
    </section>

    <!-- Posts List -->
    <section>
        <section class="blurb">
            <h2>recomendados</h2>
        </section>
        <div><br></div>
        <ul class="posts">
            @foreach($data_mini_posts as $key => $value)
                <li>
                    <article>
                        <header>
                            <h3><a href="{{ url('post/show',['id' => $value->id_post]) }}">{{ $value->title }}</a></h3>
                            <time class="published">
                                <span class="to-lowercase">publicado el </span>{{ Jenssegers\Date\Date::parse($value->created_at)->format('d F Y') }}
                            </time>
                        </header>
                        <a href="{{ url('post/show',['id' => $value->id_post]) }}" class="image">
                            <div class="thumbnail" style="margin-bottom: 0">
                                <img src="{{ asset('images/x100/' . json_decode($value->images)->x100) }}" alt=""/>
                            </div>
                        </a>
                    </article>
                </li>
            @endforeach
        </ul>
        <ul class="actions">
            <li><a href="#" class="button">saber mas</a></li>
        </ul>
    </section>

    <!-- About -->
    <section class="blurb">
        <h2>informacion</h2>
        <p><span>Soy participe de las ideas y comprometedor en proyectos por ello si tines alguna idea o sugerencia no dudes en contactarme.</span>
        </p>
        <ul class="actions">
            <li><a href="#" class="button">leer mas</a></li>
        </ul>
    </section>

    <!-- Footer -->
    <section id="footer">
        <ul class="icons">
            <li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
            <li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
        </ul>
        <p class="copyright">
            <span><a href="#" title="sitio web">www.blog.aquispe.com</a></span><br>
            <span title="copyright">&copy;</span>
            <span>Todos los Derechos Reservados {{ Carbon\Carbon::now()->format('Y') }}</span><br>
            <span title="ciudad">Huaral - Lima - Peru</span>
        </p>
    </section>

</section>