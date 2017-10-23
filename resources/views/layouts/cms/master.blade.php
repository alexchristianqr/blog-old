<!doctype html>
<html lang="en" style="background-color: #f5f5f5">
<head>
    @include('layouts.cms.top')
</head>
<body style="background-color: #f5f5f5">

<!-- /#wrapper -->
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <br>
        <!-- /#page-wrapper -->
        @include('layouts.notify')
        @yield('content')

    </div>
</div>

@include('layouts.cms.bottom')

</body>
</html>
