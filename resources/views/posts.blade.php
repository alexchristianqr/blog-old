@extends('layouts.web.app',['title'=>'posts','id_wrapper'=>'wrapper'])
@section('head')
    <meta property="og:url" content="{{ request()->getUri() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="AQUISPE.COM"/>
    <meta property="og:description"
          content="Es un sitio web blog cuyo principal objetivo es #ElAprendizajeCompartido tiene un enfoque de #RápidaComprensión para el lector y/o estudiante, está orientado más a temas de Programación o relacionado todo a Tecnología de manera gratuita y basada en documentacion oficial."/>
    <meta property="og:image" content="{{ ASSET_POSTS.'1000/routing-laravel-framework.jpg' }}"/>
@endsection
@section('content')
    <section id="view-posts">
        <!-- Pre-Posts -->
        @foreach($data as $key => $value)
            @if($key == 0)
                <article class="post post-header">
                    <header>
                        <div class="title">
                            <h2>BLOG</h2>
                            <p>CURSOS, TEORIAS E INFORMACION</p>
                        </div>
                    </header>
                </article>
            @endif
            <article class="post">
                <header>
                    <div class="title">
                        <h2>
                            <a href="{{ url('post/show',['id' => $value->slug]) }}">{{ $value->title  }}</a>
                        </h2>
                        <p>{{ $value->subtitle }}</p>
                    </div>
                    <div class="meta">
                        <time class="published">{{ Jenssegers\Date\Date::parse($value->created_at)->format('F d, Y') }}</time>
                        <a href="#" class="author">
                            <span class="name">{{ $value->user_name }}</span>
                            <img class="img-profile" src="{{ ASSET_USERS.$value->user_image }}">
                        </a>
                    </div>
                </header>
                <a href="{{ url('post/show',['id' => $value->slug]) }}">
                    <div class="thumbnail" style="border: none">
                        <img src="{{ ASSET_POSTS.'1000/'.$value->image }}">
                    </div>
                </a><!-- Imagen -->
                <p>{{ $value->description }}<span>...</span></p><!-- Descripcion -->
                <footer>
                    <ul class="actions">
                        <li>
                            <a href="{{ url('post/show',['id' => $value->slug]) }}" class="button big btn-block">ver post</a>
                        </li>
                    </ul>
                    <ul class="stats">
                        <li>
                            <a href="#" class="icon fa-thumbs-up"
                               title="a {{ $value->util }} persona(s) les resulta útil este Post."><span>{{ $value->util }}</span></a>
                        </li>
                        <li>
                            <a href="#" class="icon fa-thumbs-down"
                               title="a {{ $value->inutil }} persona(s) les resulta poco útil este Post."><span>{{ $value->inutil }}</span></a>
                        </li>
                    </ul>
                </footer>
            </article>
        @endforeach
        @if($data->hasPages())
        <!-- Pagination Simple -->
            <div class="text-center">
                {!! $data->appends($_GET)->render() !!}
            </div>
        @endif

    </section>
@endsection