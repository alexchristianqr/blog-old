<!doctype html>
<html lang="en">
<head>
    @include('layouts.web.top')
</head>
<body style="background-color: #fff">

<!-- Vertical SocialShareKit -->
<div class="ssk-sticky ssk-right ssk-center ssk-count ssk-lg ssk-developer">
    <a href="" class="ssk ssk-facebook"></a>
    <a href="" class="ssk ssk-google-plus"></a>
    <a href="" class="ssk ssk-linkedin"></a>
    <a href="" class="ssk ssk-whatsapp"></a>
    <a href="" class="ssk ssk-twitter"></a>
</div>

<!-- Header -->
@include('layouts.web.header')

<!-- Menu -->
@include('layouts.web.menu')

<!-- Main -->
<div id="main">
    <div class="container-main">
        <div class="container">
            <div class="col-md-12">
                @includeWhen(!isset($flag),'layouts.notify')
            </div>
            @yield('content')
        </div>
    </div>
</div>

<!-- Footer -->
<div class="container-fluid" hidden>
    <div class="row">
        <div class="col-md-12">
            <div id="footer-master">
                <ul class="icons">
                    <li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
                    <li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
                </ul>
                <p class="copyright">
                    <span><a href="#" title="sitio web">www.aquispe.com</a></span><br>
                    <span title="copyright">&copy;</span>
                    <span>Todos los Derechos Reservados {{ Carbon\Carbon::now()->format('Y') }}</span><br>
                    <span title="ciudad">Huaral - Lima - Peru</span>
                </p>
            </div>
        </div>
    </div>
</div>
@include('layouts.web.bottom')
</body>
</html>