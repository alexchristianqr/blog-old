<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preview | Post</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Raleway:400,800,900">
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">
</head>
<body class="single">

<!-- Wrapper -->
<div id="wrapper-posted">

    <!-- Main -->
    <div id="main">
        <section id="view-post">
            <input type="hidden" id="id_post" value="{{ $data->id }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a title="editar este post" href="{{ url('/cms/edit-post',['id' => $data->id]) }}" class="button button-main fit">Editar este Post</a>
                    </div>
                </div>
            </div>

            <!-- Post -->
                <article class="post">

                    <!-- Header Post -->
                    <header>
                        <div class="title">
                            <h2><a>{{ $data->title }}</a></h2>
                            <p>{{ $data->description_title }}</p>
                        </div>
                        <div class="meta">
                            <time class="published" datetime="2015-11-01">{{ Jenssegers\Date\Date::parse($data->created_at)->format('d F Y') }}</time>
                            <a href="#" class="author">
                                <span class="name">{{ $data->user_name }}</span>
                                <img class="img-profile" src="{{ ASSET_USERS.$data->user_image }}" alt="auto">
                            </a>
                        </div>
                    </header>

                    <!-- Content Post -->
                    <section>
                        <div class="thumbnail" style="border: none"><img src="{{ ASSET_POSTS.'1000/'.$data->image }}" alt=""></div>
                        <p>{{ $data->introduction }}</p>
                        {!!  $data->content !!}
                    </section>

                    <!-- Footer Post -->
                    <footer>
                        <div class="end-publicado">
                            <ul id="community">
                                <li>
                                    <a href id="btnUtil" style="border-style: none;" data-community="util" title="cantidad de persona(s) que les resulta útil este Post.">
                                        <div style="margin-bottom: 1em;"><i class="fa fa-thumbs-o-up fa-3x"></i></div>
                                        <div><span class="badge">0</span></div>
                                    </a>
                                </li>
                                <li>
                                    <a href id="btnInutil" style="border-style: none;" data-community="inutil" title="cantidad de persona(s) que les resulta poco útil este Post.">
                                        <div style="margin-bottom: 1em;"><i class="fa fa-thumbs-o-down fa-3x"></i></div>
                                        <div><span class="badge">0</span></div>
                                    </a>
                                </li>
                            </ul>
                            <div class="text-center">
                                <p style="color: #aaa;"><span>¿Te resulto útil el Post?</span></p>
                            </div>
                        </div>
                    </footer>

                    <!-- Relations -->
                    <section>
                        <div class="blurb">
                            <h2>Tags Relacionados</h2>
                            <hr>
                        </div>
                        <div class="form-group">
                            <ul class="tags">
                                    <li><a href="#" class="tag">Test 1</a>
                                    <li><a href="#" class="tag">Test 2</a>
                                    <li><a href="#" class="tag">Test 3</a>
                            </ul>
                        </div>
                    </section>

                <!-- Comments -->
                <section>
                    @include('layouts.web.disqus',['id' => $data->id])
                </section>

            </article>

            <!-- Footer -->
            @include('layouts.web.firma')

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a title="editar este post" href="{{ url('/cms/edit-post',['id' => $data->id]) }}" class="button button-main fit">Editar este Post</a>
                    </div>
                </div>
            </div>

        </section>
    </div>

</div>

<script src="{{ asset('js/app.min.js') }}"></script>

</body>
</html>