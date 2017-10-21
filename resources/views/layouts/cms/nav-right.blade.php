<ul class="nav navbar-top-links navbar-right">
    <!-- /.dropdown -->
    <!-- /.dropdown -->
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="text-capitalize">{{ auth()->user()->name }}</span>&nbsp;
            <span class="small">({{ strtolower(session('session_type_user')->name) }})</span>&nbsp;&nbsp;
            <span class="avatar-image"><img alt="User" src="{{ !empty(auth()->user()->image) ? ASSET_USERS.auth()->user()->image : auth()->user()->avatar }}" width="30"></span>&nbsp;&nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ url('/') }}" target="_blank"><i class="fa fa-mixcloud fa-fw"></i>Sitio Web</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>