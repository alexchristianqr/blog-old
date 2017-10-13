<!doctype html>
<html lang="en">
<head>
    @include('layouts.web.top')
    @if(request()->getRequestUri() == '/')
        <meta property="og:url" content="{{ request()->getUri() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="aquispe.com"/>
        <meta property="og:description" content="aquispe.com es un sitio blog, cuyo principal objetivo es el Aprendizaje ." />
        <meta property="og:image" content="{{ ASSET_POSTS.'1000/routing-laravel-framework.jpg' }}"/>
    @else
        @yield('head')
    @endif
</head>
<body class="{{ isset($body) ? $body : '' }}">

<!-- Vertical SocialShareKit -->
<div class="ssk-sticky ssk-right ssk-center ssk-count ssk-lg ssk-developer">
    <a href="" class="ssk ssk-facebook"></a>
    <a href="" class="ssk ssk-google-plus"></a>
    <a href="" class="ssk ssk-linkedin"></a>
    <a href="" class="ssk ssk-whatsapp"></a>
    <a href="" class="ssk ssk-twitter"></a>
</div>

<!-- Button Up-->
<a id="btnUp" class="fade in hidden"><i class="fa fa-chevron-up"></i></a>

<!-- Wrapper -->
{{--<div id="wrapper">--}}
<div id="{{ isset($id_wrapper) ? $id_wrapper : '' }}">

    <!-- Header -->
@include('layouts.web.header')

<!-- Menu -->
@include('layouts.web.menu')

<!-- Main -->
    <div id="main">
        @yield('content')
    </div>

    <!-- Sidebar -->
    @includeWhen(isset($body) == '','layouts.web.sidebar')

</div>

<!-- Scripts JS -->
@include('layouts.web.bottom')

</body>
</html>