@extends('layouts.web.app',['title'=>'Blog','id_wrapper'=>'wrapper'])
@section('content')
    <section id="view-posts">

        <!-- Pre-Posts -->
        @foreach($data as $key => $value)
            @if($key == 0 )
                <article class="post post-header">
                    <header>
                        <div class="title">
                            <h2>BLOG</h2>
                            <p>cursos, tutorial, post, noticias y más.</p>
                        </div>
                    </header>
                </article>
            @endif
            <article class="post">
                <header>
                    <div class="title">
                        <h2>
                            <a href="{{ url('post/show',['id' => $value->id,'id_category'=>$value->id_category]) }}">{{ $value->title  }}</a>
                        </h2>
                        <p>{{ $value->description_title }}</p>
                    </div>
                    <div class="meta">
                        <time class="published">{{ Jenssegers\Date\Date::parse($value->created_at)->format('d F Y') }}</time>
                        <a href="#" class="author">
                            <span class="name">{{ $value->user_name }}</span>
                            <img class="img-profile" src="{{ ASSET_USERS.$value->user_image }}">
                        </a>
                    </div>
                </header>
                    <a href="{{ url('post/show',['id' => $value->id,'id_category'=>$value->id_category]) }}" >
                        <div class="thumbnail">
                            <img src="{{ ASSET_POSTS.$value->image }}">
                        </div>
                    </a><!-- Imagen -->
                    <p>{{ $value->introduction }}<span>...</span></p><!-- Descripcion -->
                <footer>
                    <ul class="actions">
                        <li>
                            <a href="{{ url('post/show',['id' => $value->id,'id_category'=>$value->id_category]) }}" class="button big btn-block">ver post</a>
                        </li>
                    </ul>
                    <ul class="stats">
                        <li><a class="icon fa-thumbs-up" title="a {{ $value->util }} persona(s) les resulta útil este Post."><span>{{ $value->util }}</span></a></li>
                        <li><a class="icon fa-thumbs-down" title="a {{ $value->inutil }} persona(s) les resulta poco útil este Post."><span>{{ $value->inutil }}</span></a></li>
                    </ul>
                </footer>
            </article>
        @endforeach

        <!-- Paginado  -->
        <div class="text-center">
            {!! $data->render() !!}
        </div>

    </section>
@endsection