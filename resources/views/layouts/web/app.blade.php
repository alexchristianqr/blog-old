<!doctype html>
<html lang="en">
<head>
    @include('layouts.web.top')
    @yield('head')
    <div id="fb-root"></div>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10&appId=463978944000718";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
<body class="{{ isset($body)?$body:'' }}">

@if($_SERVER['SERVER_NAME'] == "dev.aquispe.com")
    <?php $glob = glob(str_replace('\storage\framework\views', '\public\templates', __DIR__) . '\*.html'); ?>
@else
    <?php $glob = glob(str_replace('/storage/framework/views', '/public/templates', __DIR__) . '/*.html'); ?>
@endif

@foreach($glob as $filename)
    @php
        require_once $filename;
@endphp
    @endforeach

    <!-- Vertical SocialShareKit -->
        <div class="ssk-sticky ssk-right ssk-center ssk-count ssk-lg ssk-developer">
            <a href="" class="ssk ssk-facebook"></a>
            <a href="" class="ssk ssk-google-plus"></a>
            <a href="" class="ssk ssk-linkedin"></a>
            <a href="" class="ssk ssk-whatsapp"></a>
            {{--<a href="" class="ssk ssk-twitter"></a>--}}
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