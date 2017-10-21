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
            <h3>NEWS</h3>
            <br>
            <div class="mini-posts">
                <!-- Mini Post -->
                @foreach($data_pre_posts as $key => $value)
                    <article class="mini-post">
                        <header>
                            <h3><a href="#">{{ $value->title }}</a></h3>
                            <time class="published">
                                <i class="fa fa-calendar-times-o fa-fw"></i>&nbsp;
                                <span>{{ Jenssegers\Date\Date::parse($value->date_publication)->format('F d, Y') }}</span>
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
            <input type="email" name="email" placeholder="e-mail" title="email para la suscripcion" class="form-control"
                   required/>
        </div>
        <div class="form-group">
            <button title="recibir proximas publicaciones y/o novedades por email." type="submit"
                    class="button btn-block big">SUSCRIBIRME
            </button>
        </div>
        {!! Form::close() !!}
    </section>

    <!-- Posts List Recomendados -->
    @isset($data_mini_posts)
        <section class="blurb">
            <h3>RECOMENDADOS</h3>
            <br>
            <ul class="posts">
                @foreach($data_mini_posts as $key => $value)
                    <li>
                        <article>
                            <header>
                                <h3>
                                    <a href="{{ url('post/show',['id' => $value->slug]) }}">{{ $value->title }}</a>
                                </h3>
                                <time class="published">
                                    <i class="fa fa-calendar fa-fw"></i>{{ Jenssegers\Date\Date::parse($value->created_at)->format('F d, Y') }}
                                </time>
                            </header>
                            <a href="{{ url('post/show',['id' => $value->slug]) }}"
                               class="image">
                                <div class="thumbnail">
                                    <img src="{{ ASSET_POSTS.'300/' . $value->image }}"/>
                                </div>
                            </a>
                        </article>
                    </li>
                @endforeach
            </ul>
            @if($data_mini_posts->hasPages())
                <!-- Pagination Simple -->
                {!! $data_mini_posts->appends($_GET)->render() !!}
            @endif
        </section>
    @endisset

    <!-- About -->
    <section class="blurb">
        <h3>INFORMACION</h3>
        <br>
        <p>
            <span>Es un sitio web blog cuyo principal objetivo es <b>"Compartir el Conocimiento"</b> y tiene un enfoque de <b>"Rápido Aprendizaje"</b> para el lector y/o estudiante, está orientado más a temas de Programación o relacionado todo a Tecnología de manera gratuita y basada en documentación oficial.</span>
        </p>
    </section>

    <!-- Footer -->
    @include('layouts.web.firma')

</section>
