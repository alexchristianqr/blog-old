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
                            <p>CURSOS, TEORIAS E INFORMACION</p>
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
                <a href="{{ url('post/show',['id' => $value->id,'id_category'=>$value->id_category]) }}">
                    <div class="thumbnail" style="border: none">
                        <img src="{{ ASSET_POSTS.'1000/'.$value->image }}">
                    </div>
                </a><!-- Imagen -->
                <p>{{ $value->description }}<span>...</span></p><!-- Descripcion -->
                <footer>
                    <ul class="actions">
                        <li>
                            <a href="{{ url('post/show',['id' => $value->id,'id_category'=>$value->id_category]) }}" class="button big btn-block">ver post</a>
                        </li>
                    </ul>
                    <ul class="stats">
                        <li>
                            <a href="#" class="icon fa-thumbs-up" title="a {{ $value->util }} persona(s) les resulta útil este Post."><span>{{ $value->util }}</span></a>
                        </li>
                        <li>
                            <a href="#" class="icon fa-thumbs-down" title="a {{ $value->inutil }} persona(s) les resulta poco útil este Post."><span>{{ $value->inutil }}</span></a>
                        </li>
                    </ul>
                </footer>
            </article>
    @endforeach

    <!-- Pagination  -->
        <div class="text-center">
            @if($data->hasPages())
                {!! $data->render() !!}
            @endif
        </div>

    </section>
@endsection