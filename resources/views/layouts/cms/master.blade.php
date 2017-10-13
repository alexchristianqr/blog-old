<!doctype html>
<html lang="en">
<head>

    @include('layouts.cms.top')

</head>
<body>

    <!-- /#page-wrapper -->
    <div class="container">
        {{--@include('layouts.notify')--}}
        @yield('content')
    </div>

@include('layouts.cms.bottom')

</body>
</html>
