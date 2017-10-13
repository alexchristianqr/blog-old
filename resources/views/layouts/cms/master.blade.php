<!doctype html>
<html lang="en">
<head>
    @include('layouts.cms.top')

    <style>
        html{
            background-color:inherit;
        }
    </style>
</head>
<body>

<!-- /#wrapper -->
{{--<div id="wrapper">--}}

{{--@include('layouts.cms.modals')--}}

<!-- Navigation -->
    {{--<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 10px; background-color: #fff">--}}
    {{--@include('layouts.cms.nav-left')--}}
    <!-- /.navbar-header -->

    {{--@include('layouts.cms.nav-right')--}}
    <!-- /.navbar-top-links -->

    {{--@include('layouts.cms.sidebar')--}}
    <!-- /.navbar-static-side -->
    {{--</nav>--}}

    <!-- /#page-wrapper -->
    <div class="container">
        {{--@include('layouts.notify')--}}
        @yield('content')
    </div>

{{--</div>--}}

@include('layouts.cms.bottom')

</body>
</html>
