<div class="navbar-default sidebar" role="navigation" style="background-color: #fff">
    <div class="sidebar-nav navbar-collapse" style="background-color: #fff">
        <ul class="nav" id="side-menu" style="background-color: #fff">
                <li class="href">
                    <a href="#"><i class="fa fa-user fa-fw"></i>Gestion Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('cms/users') }}">
                                <span><i class="fa fa-users fa-fw"></i>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('cms/user') }}">
                                <span><i class="fa fa-plus fa-fw"></i>Create User</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="href">
                    <a href="#"><i class="fa fa-html5 fa-fw"></i>Gestion Site Web<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{  url('cms/posts?status=A') }}">
                                <span><i class="fa fa-files-o fa-fw"></i>Posts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('cms/post') }}">
                                <span><i class="fa fa-plus fa-fw"></i>Create Post</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('cms/portfolio') }}">
                                <span><i class="fa fa-plus fa-fw"></i>Portfolio</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="href">
                    <a href="#"><i class="fa fa-html5 fa-fw"></i>Gestion Tables<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('cms/tables') }}">
                                <span><i class="fa fa-list fa-fw"></i>Tables</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>