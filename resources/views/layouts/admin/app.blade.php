<!doctype html>
<html lang="en">
<head>
    @include('layouts.admin.top')
</head>
<body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 10px">
    @include('layouts.admin.nav-left')
    <!-- /.navbar-header -->

    @include('layouts.admin.nav-right')
    <!-- /.navbar-top-links -->

    @include('layouts.admin.sidebar')
    <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper" style="padding-top: 80px;">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
@include('layouts.admin.bottom')
</body>
</html>