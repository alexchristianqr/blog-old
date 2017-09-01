@extends('layouts.web.app',['title'=>'Post'])
@section('content')
    <!-- Post -->
    <article class="post">

        <!-- Encabezado Post -->
        <header>
            <div class="title">
                <h2><a> {!!  $data->title !!}</a></h2>
                <p>{!! $data->content_title !!}</p>
            </div><!--titulo post-->
            <div class="meta">
                <time class="published">{{ Jenssegers\Date\Date::parse($data->created_at)->format('d M Y') }}</time>
                <a href="#" class="author">
                    <span class="name">{{ $data->user_name }}</span>
                    <img class="img-profile" src="{{ asset('images/'.$data->user_image) }}" alt="auto">
                </a>
            </div><!--imagen usuario-->
        </header>

        <!-- Imagen Post -->
        <a>
            <div class="thumbnail">
                <img src="{{ asset('/images/x600/'.json_decode($data->images)->x600) }}" alt="">
            </div>
        </a>

        <!-- Pre-Contenido Post -->
        <p>{{ $data->description }}</p>

        <!-- Contenido Post -->
    {!!  $data->body !!}

    <!-- Paginado Post-->
        <div class="end-publicado">
            <div class="meta">
                <time class="published">{{ Jenssegers\Date\Date::parse($data->created_at)->format('d M Y') }}</time>
                <a href="#" class="author" style="padding-bottom: 1em">
                    <span class="name"><span
                                class="to-lowercase">publicado por&nbsp;</span>{{ $data->user_name }}</span>
                    <img class="img-profile" src="{{ asset('images/'.$data->user_image) }}" alt="">
                </a>
            </div><!-- imagen usuario auth -->
        </div>

        <!-- Posts Relacionados -->
        <section class="blurb">
            <h2>relacionados al post</h2>
        </section>
        <div><br></div>
        <div class="row-dev">
            @foreach($data_groups->chunk(3) as $valuedata)
                @foreach($valuedata as $key => $value)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <article class="mini-post">
                                <header style="padding: 0;">
                                    <div style="padding: 1em !important;text-align: left;">
                                        <a href="{{ url('post/show',['id' => $value->id,'id_tipo_post'=>$value->id_tipo_post]) }}" class="button">ver post</a>
                                    </div>
                                </header>
                                <header>
                                    <h3 style="min-height:36px;max-height: 50px;"><a href="#">{{ $value->title }}</a>
                                    </h3>
                                    <time class="published">
                                        <span class="name"><span class="to-lowercase">publicado por&nbsp;</span>{{ $value->user_name }}</span><br>
                                        <span>{{ Jenssegers\Date\Date::parse($value->date_publication)->format('d M Y H:i a') }}</span>
                                    </time>
                                    <a href="#" class="author">
                                        <img class="img-profile" src="{{ asset('images/'.$value->user_image) }}" alt=""/>
                                    </a>
                                </header>
                            </article>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>

    </article>
@endsection