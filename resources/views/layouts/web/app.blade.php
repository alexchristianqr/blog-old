<!doctype html>
<html lang="en">
<head>
    @include('layouts.web.top')
</head>
<body class="{{ isset($body) ? $body : '' }}">

<!-- Vertical SocialShareKit -->
<div class="ssk-group ssk-sticky ssk-right ssk-center ssk-count ssk-lg ssk-developer">
    <a href="" class="ssk ssk-facebook"></a>
    <a href="" class="ssk ssk-google-plus"></a>
    <a href="" class="ssk ssk-whatsapp"></a>
    <a href="" class="ssk ssk-linkedin"></a>
</div>

<!-- Button Up-->
<a id="btnUp" class="fade in hidden"><i class="fa fa-chevron-up"></i></a>

<!-- Wrapper -->
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