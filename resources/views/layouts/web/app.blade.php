<!doctype html>
<html lang="en">
<head>
    @include('layouts.web.top')
</head>
<body>
<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    @include('layouts.web.header')

    <!-- Menu -->
    @include('layouts.web.menu')

    <!-- Main -->
    <div id="main">
        @yield('content')
    </div>

    <!-- Sidebar -->
    @include('layouts.web.sidebar')

</div>

@include('layouts.web.bottom')

</body>
</html>