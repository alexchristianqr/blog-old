<div class="navbar-default sidebar" role="navigation" style="background-color: #fff">
    <div class="sidebar-nav navbar-collapse" style="background-color: #fff">
        <ul class="nav" id="side-menu" style="background-color: #fff">
            <li class="href">
                <a href="#"><i class="fa fa-dashboard fa-fw"></i>Home<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('cms/home') }}">
                            <span><i class="fa fa-exclamation-circle fa-fw"></i>About</span>
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="{{ url('cms/about') }}">--}}
                            {{--<span><i class="fa fa-info-circle fa-fw"></i>About</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </li>
            @isset(session('session_roles')->role_user)
                <li class="href">
                    <a href="#"><i class="fa fa-user fa-fw"></i>Manage Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @isset(session('session_roles')->role_user_list)
                            <li>
                                <a href="{{ url('cms/users') }}">
                                    <span><i class="fa fa-users fa-fw"></i>Users</span>
                                </a>
                            </li>
                        @endisset
                        @isset(session('session_roles')->role_user_create)
                            <li>
                                <a href="{{ url('cms/user')}}">
                                    <span><i class="fa fa-plus fa-fw"></i>New User</span>
                                </a>
                            </li>
                        @endisset
                    </ul>
                </li>
            @endisset
            @if(isset(session('session_roles')->role_post) || isset(session('session_roles')->role_portfolio))
                <li class="href">
                    <a href="#"><i class="fa fa-html5 fa-fw"></i>Manage Site<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(isset(session('session_roles')->role_post) && isset(session('session_roles')->role_post_list))
                            <li>
                                <a href="{{  url('cms/posts?status=A') }}">
                                    <span><i class="fa fa-files-o fa-fw"></i>Posts</span>
                                </a>
                            </li>
                        @endif
                        @if(isset(session('session_roles')->role_post) && isset(session('session_roles')->role_post_create))
                            <li>
                                <a href="{{ url('cms/post') }}">
                                    <span><i class="fa fa-plus fa-fw"></i>New Post</span>
                                </a>
                            </li>
                        @endif
                        @if(isset(session('session_roles')->role_portfolio) && isset(session('session_roles')->role_portfolio_list))
                            <li>
                                <a href="{{ url('cms/portfolios') }}">
                                    <span><i class="fa fa-list fa-fw"></i>Portfolios</span>
                                </a>
                            </li>
                        @endif
                        @if(isset(session('session_roles')->role_portfolio) && isset(session('session_roles')->role_portfolio_create))
                            <li>
                                <a href="{{ url('cms/portfolio') }}">
                                    <span><i class="fa fa-plus fa-fw"></i>New Portfolio</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @isset(session('session_roles')->role_tables)
                <li class="href">
                    <a href="#"><i class="fa fa-list-ol fa-fw"></i>Manage Tables<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @isset(session('session_roles')->role_tables_list)
                            <li>
                                <a href="{{ url('cms/tables') }}">
                                    <span><i class="fa fa-list fa-fw"></i>Tables</span>
                                </a>
                            </li>
                        @endisset
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>