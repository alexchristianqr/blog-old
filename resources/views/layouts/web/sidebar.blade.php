<section id="sidebar">

    <!-- Intro -->
    <section id="intro">
        <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/users/perfil.png')  }}" alt="imagen"/></a>
        <header>
            <h2>ALEX CHRISTIAN</h2>
            <p><span>ANALISTA PROGRAMADOR FULL STACK COMPROMISO, TIEMPO Y PASION</span></p>
        </header>
    </section>

    <!-- Mini Posts -->
    @isset($data_pre_posts)
        <section class="blurb">
            <h3>PROXIMAMENTE</h3>
            <br>
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
                                <img src="{{ ASSET_POSTS.'1000/'.$value->image }}" alt="imagen"/>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    @endisset

    <!-- Subscription -->
    <section class="blurb">
        <h3>SUSCRIBETE</h3>
        <br>
        {!! Form::open(['url'=>'subscription/email','method'=>'POST']) !!}
        <div class="form-group">
            <p>
                <span>Para recibir más información del próximo Curso, Post, Noticia o alguna Novedad a publicarse.</span>
            </p>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="e-mail" title="email para la suscripcion" class="form-control" required/>
        </div>
        <div class="form-group">
            <button title="recibir proximas publicaciones y/o novedades por email." type="submit" class="button btn-block big">SUSCRIBIRME</button>
        </div>
        {!! Form::close() !!}
    </section>

    <!-- Posts List Novedades -->
    @if(isset($data_novedades))
        <section class="blurb">
            <h3>ULTIMAS NOVEDADES</h3>
            <br>
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
                            <a href="{{ url('post/show',['id' => $value->id_post,'id_category' => $value->id_category]) }}"
                               class="image">
                                <div class="thumbnail">
                                    <img src="{{ ASSET_POSTS.'300/'. $value->image }}"/>
                                </div>
                            </a>
                        </article>
                    </li>
                @endforeach
            </ul>
            <ul class="actions" hidden>
                <li><a href="#" class="button">SABER MAS</a></li>
            </ul>
        </section>
    @endif

    <!-- Posts List Recomendados -->
    @if(isset($data_mini_posts))
        <section class="blurb">
            <h3>RECOMENDADOS</h3>
            <br>
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
                                <div class="thumbnail">
                                    <img src="{{ ASSET_POSTS.'300/' . $value->image }}"/>
                                </div>
                            </a>
                        </article>
                    </li>
                @endforeach
            </ul>
            <ul class="actions" hidden>
                <li><a href="#" class="button">SABER MAS</a></li>
            </ul>
        </section>
    @endif

    <!-- About -->
    <section class="blurb hidden">
        <h3>INFORMACION</h3>
        <br>
        <p>
            <span>Soy participe de las ideas y comprometedor en proyectos por ello si tines alguna idea o sugerencia no dudes en contactarme.</span>
        </p>
        <ul class="actions">
            <li><a href="#" class="button">LEER MAS</a></li>
        </ul>
    </section>

    <!-- Footer -->
    @include('layouts.web.firma')

</section>