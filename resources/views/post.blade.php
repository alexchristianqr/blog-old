@extends('layouts.web.app',['title'=>'post','body'=>'single','id_wrapper'=>'wrapper-posted'])
@section('head')
    <meta property="og:url" content="{{ request()->getUri() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ strtoupper($data->title) }}"/>
    <meta property="og:description" content="{{ $data->description }}"/>
    <meta property="og:image" content="{{ ASSET_POSTS.'1000/'.$data->image }}"/>
@endsection
@section('content')
    <section id="view-post">
        <input type="hidden" id="id_post" value="{{ $data->id }}">

        <!-- Post -->
        <article class="post">

            <!-- Header Post -->
            <header>
                <div class="title">
                    <h2><a>{{ $data->title }}</a></h2>
                    <p>{{ $data->subtitle }}</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">{{ Jenssegers\Date\Date::parse($data->created_at)->format('F d, Y') }}</time>
                    <a href="#" class="author">
                        <span class="name">{{ $data->user_name }}</span>
                        <img class="img-profile" src="{{ ASSET_USERS.$data->user_image }}" alt="auto">
                    </a>
                </div>
            </header>

            <!-- Content Post -->
            <section>
                <div class="thumbnail" style="border: none"><img src="{{ ASSET_POSTS.'1000/'.$data->image }}"></div>
                <p>{{ $data->description }}</p>
                {!!  $data->content !!}
            </section>

            <!-- Footer Post -->
            <footer>
                <div class="end-publicado" style="margin-top: 1.5em;margin-bottom: 1.5em">
                    <ul id="community">
                        <li>
                            <a href id="btnUtil" style="border-style: none;" data-community="util" title="cantidad de persona(s) que les resulta útil este Post.">
                                <div style="margin-bottom: 1em;"><i class="fa fa-thumbs-o-up fa-2x"></i></div>
                                <div><span class="">0</span></div>
                            </a>
                        </li>
                        <li>
                            <a href id="btnInutil" style="border-style: none;" data-community="inutil" title="cantidad de persona(s) que les resulta poco útil este Post.">
                                <div style="margin-bottom: 1em;"><i class="fa fa-thumbs-o-down fa-2x"></i></div>
                                <div><span class="">0</span></div>
                            </a>
                        </li>
                    </ul>
                    <div class="text-center">
                        <p style="color: #aaa;">¿Te ha resultado útil este documento?</p>
                    </div>
                </div>
            </footer>

            <!-- Relations -->
            @if(isset($previous) || isset($next))
                <section>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <ul class="actions pagination">
                                @if($previous)
                                    <li style="float: left;">
                                        <div class="form-group">
                                            <a href="{{ url( 'post/show',['id' => $previous->slug]) }}" class="button fit previous">{{ $previous->title }}</a>
                                        </div>
                                    </li>
                                @endif
                                @if($next)
                                    <li style="float: right;">
                                        <div class="form-group">
                                            <a href="{{ url( 'post/show',['id' => $next->slug]) }}" class="button fit next">{{ $next->title }}</a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <br>
                </section>
            @endif

            @isset($tags)
                <section>
                    <div class="blurb">
                        <h3>Tags Relacionados</h3>
                        <br>
                    </div>
                    <div class="form-group">
                        <ul class="tags">
                            @foreach($tags as $value)
                                <li><a href="{{ url('/search?query='.$value->name) }}" class="tag">{{ $value->name }}</a>
                            @endforeach
                        </ul>
                    </div>
                </section>
        @endisset

        <!-- Comments -->
            <section>
                @include('layouts.web.disqus',['id'=>$data->id])
            </section>

        </article>

        <!-- Footer -->
        @include('layouts.web.firma')

    </section>
@endsection