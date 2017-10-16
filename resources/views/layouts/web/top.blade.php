<title>{{ (!isset($title) ? 'Blog | Web' : $title) }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">

<meta property="fb:app_id" content="1559888187404310"/>
@if(request()->getRequestUri() == '/')
    <meta property="og:url" content="{{ request()->getUri() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="aquispe.com"/>
    <meta property="og:description" content="aquispe.com es un sitio blog, cuyo principal objetivo es el Aprendizaje" />
    <meta property="og:image" content="{{ ASSET_POSTS.'1000/routing-laravel-framework.jpg' }}"/>
@else
    @yield('head')
@endif

<!-- Store CSRF token for AJAX calls -->
<meta name="csrf_token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Raleway:400,800,900">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />

@if(env('APP_ENV') == 'local')
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/social-share-kit/dist/css/social-share-kit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.dev.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">
@endif