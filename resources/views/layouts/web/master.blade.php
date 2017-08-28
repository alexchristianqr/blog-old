<!doctype html>
<html lang="en">
<head>
    @include('layouts.web.top')
</head>
<body style="background-color: #fff;">

<!-- Header -->
@include('layouts.web.header')

<!-- Menu -->
@include('layouts.web.menu')

<!-- Main -->
<div id="main" style="width: 100%;margin-bottom: 0;height: calc(100vh - 175px)">
    <div><br></div>
    @yield('content')
</div>

<!-- Footer -->
<div class="container-fluid">
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
                    <span><a href="#" title="sitio web">www.blog.aquispe.com</a></span><br>
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