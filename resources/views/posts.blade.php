@extends('layouts.web.app',['title'=>'Posts'])
@section('content')
    @foreach($data as $key => $value)
        <!-- Pre-Posts -->
        @if($key == 0 )
            <article class="post post-dev">
                <header>
                    <div class="title">
                        <h2>blog</h2>
                        <p>cursos, post, noticias.</p>
                    </div>
                </header>
            </article>
        @endif
        <article class="post">
            <header>
                <div class="title">
                    <h2><a href="{{ url('post/show',['id' => $value->id,'id_tipo_post'=>$value->id_tipo_post]) }}">{{ $value->title  }}</a></h2>
                    <p>{{ $value->content_title }}</p>
                </div>
                <div class="meta">
                    <time class="published">{{ Jenssegers\Date\Date::parse($value->created_at)->format('d M Y') }}</time>
                    <a href="#" class="author">
                        <span class="name">{{ $value->user_name }}</span>
                        <img class="img-profile" src="{{ asset('images/'.$value->user_image) }}" alt="auto">
                    </a>
                </div>
            </header><!-- Titulo -->
            <a href="{{ url('post/show',['id' => $value->id,'id_tipo_post'=>$value->id_tipo_post]) }}">
                <div class="thumbnail">
                    <img src="{{ asset('images/x600/'.json_decode($value->images)->x600) }}" alt="">
                </div>
            </a><!-- Imagen -->
            <p>{{ $value->description }}<span>...</span></p><!-- Descripcion -->
            <footer>
                <ul class="actions">
                    <li>
                        <a href="{{ url('post/show',['id' => $value->id,'id_tipo_post'=>$value->id_tipo_post]) }}"
                           class="button big btn-block">ver post</a>
                    </li>
                </ul>
                <ul class="stats">
                    <li><a href="#">General</a></li>
                    <li><a href="#" class="icon fa-heart">28</a></li>
                    <li><a href="#" class="icon fa-comment">128</a></li>
                </ul>
            </footer><!-- pie de pagina prePost -->
        </article>
    @endforeach

    <!-- Paginado  -->
    <div class="text-center">
        {!! $data->links(); !!}
    </div>


@endsection