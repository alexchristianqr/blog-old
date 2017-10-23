<!doctype html>
<html lang="en">
<head>
    @include('layouts.cms.top')

</head>
<body>

<!-- /#wrapper -->
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 10px; background-color: #fff">
        @include('layouts.cms.nav-left')
        <!-- /.navbar-header -->

        @include('layouts.cms.nav-right')
        <!-- /.navbar-top-links -->

        @include('layouts.cms.sidebar')
        <!-- /.navbar-static-side -->
    </nav>

    <!-- /#page-wrapper -->
    <div id="page-wrapper">
        @include('layouts.notify')
        @yield('content')
    </div>

</div>

@include('layouts.cms.bottom')
</body>
</html>
