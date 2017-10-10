<section id="sidebar">

    <!-- Intro -->
    <section id="intro">
        <div>
            <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/users/perfil.png')  }}" alt="imagen"/></a>
        </div>
        <header>
            <h2>ALEX CHRISTIAN</h2>
            <p><span>ANALISTA PROGRAMADOR FULL STACK ACTITUD, TIEMPO Y PASION</span></p>
        </header>
    </section>

    <!-- Mini Posts -->
    <section>
        <div class="blurb">
            <h2>PROXIMAMENTE</h2>
            <hr>
        </div>
        <div class="mini-posts">
            <!-- Mini Post -->
            @foreach($data_pre_posts as $key => $value)
                <article class="mini-post">
                    <header>
                        <h3><a href="#">{{ $value->title }}</a></h3>
                        <time class="published">
                            <i class="fa fa-calendar-times-o fa-fw"></i>&nbsp;
                            <span>{{ Jenssegers\Date\Date::parse($value->date_publication)->format('d F Y') }}</span>
                        </time>
                        <a href="#" class="author"><img class="img-profile" src="{{ ASSET_USERS.$value->user_image }}" alt="imagen"></a>
                    </header>
                    <a class="image">
                        <div class="thumbnail thumbnail-minipost">
                            <img src="{{ ASSET_POSTS.$value->image }}" alt="imagen"/>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    <!-- Subscription -->
    <section>
        <div class="blurb">
            <h2>SUSCRIBETE</h2>
            <hr>
        </div>
        <form action="{{ url('subscription/email') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group blurb">
                <p>
                    <span>Para recibir más información del próximo Curso, Post, Noticia o alguna Novedad a publicarse.</span>
                </p>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="e-mail" title="email para la suscripcion"
                       class="form-control" required/>
            </div>
            <div class="form-group">
                <button title="recibir proximas publicaciones y/o novedades por email." type="submit" class="button btn-block">SUSCRIBIRME</button>
            </div>
        </form>
    </section>

    <!-- Posts List Novedades -->
    <section>
        <div class="blurb">
            <h2>ULTIMAS NOVEDADES</h2>
            <hr>
        </div>
        <ul class="posts">
            @foreach($data_mini_posts as $key => $value)
                <li>
                    <article>
                        <header>
                            <h3>
                                <a href="{{ url('post/show',['id' => $value->id_post,'id_category' => $value->id_category]) }}">{{ $value->title }}</a>
                            </h3>
                            <time class="published">
                                <i class="fa fa-calendar fa-fw"></i>
                                <span>{{ Jenssegers\Date\Date::parse($value->created_at)->format('d F Y') }}</span>
                            </time>
                        </header>
                        <a href="{{ url('post/show',['id' => $value->id_post,'id_category' => $value->id_category]) }}" class="image">
                            <div class="thumbnail" style="margin-bottom: 0;padding: 0;">
                                <img src="{{ asset('images/background/' . $value->image) }}"/>
                            </div>
                        </a>
                    </article>
                </li>
            @endforeach
        </ul>
        <ul class="actions">
            <li><a href="#" class="button">SABER MAS</a></li>
        </ul>
    </section>

    <!-- Posts List Recomendados -->
    <section>
        <div class="blurb">
            <h2>RECOMENDADOS</h2>
            <hr>
        </div>
        <ul class="posts">
            @foreach($data_mini_posts as $key => $value)
                <li>
                    <article>
                        <header>
                            <h3>
                                <a href="{{ url('post/show',['id' => $value->id_post,'id_category' => $value->id_category]) }}">{{ $value->title }}</a>
                            </h3>
                            <time class="published">
                                <i class="fa fa-calendar fa-fw"></i>{{ Jenssegers\Date\Date::parse($value->created_at)->format('d F Y') }}
                            </time>
                        </header>
                        <a href="{{ url('post/show',['id' => $value->id_post,'id_category' => $value->id_category]) }}"
                           class="image">
                            <div class="thumbnail" style="margin-bottom: 0;padding: 0;">
                                <img src="{{ asset('images/background/' . $value->image) }}"/>
                            </div>
                        </a>
                    </article>
                </li>
            @endforeach
        </ul>
        <ul class="actions">
            <li><a href="#" class="button">SABER MAS</a></li>
        </ul>
    </section>

    <!-- About -->
    <div class="blurb">
        <h2>INFORMACION</h2>
        <hr>
        <p>
            <span>Soy participe de las ideas y comprometedor en proyectos por ello si tines alguna idea o sugerencia no dudes en contactarme.</span>
        </p>
        <ul class="actions">
            <li><a href="#" class="button">LEER MAS</a></li>
        </ul>
    </div>

    <!-- Footer -->
    @include('layouts.web.firma')

</section>