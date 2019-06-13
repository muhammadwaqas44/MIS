<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">


            <li class="nav-item start open">
                <a href="{{route('admin-dashboard')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>

            </li>


            {{--<li class="heading">--}}
                {{--<h3 class="uppercase">Layouts</h3>--}}
            {{--</li>--}}

            {{--<li class="nav-item  ">--}}
                {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                    {{--<i class="icon-feed"></i>--}}
                    {{--<span class="title">Sidebar Layouts</span>--}}
                    {{--<span class="arrow"></span>--}}
                {{--</a>--}}
                {{--<ul class="sub-menu">--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_sidebar_menu_light.html" class="nav-link ">--}}
                            {{--<span class="title">Light Sidebar Menu</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_sidebar_menu_hover.html" class="nav-link ">--}}
                            {{--<span class="title">Hover Sidebar Menu</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_sidebar_search_1.html" class="nav-link ">--}}
                            {{--<span class="title">Sidebar Search Option 1</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_sidebar_search_2.html" class="nav-link ">--}}
                            {{--<span class="title">Sidebar Search Option 2</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_toggler_on_sidebar.html" class="nav-link ">--}}
                            {{--<span class="title">Sidebar Toggler On Sidebar</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_sidebar_reversed.html" class="nav-link ">--}}
                            {{--<span class="title">Reversed Sidebar Page</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_sidebar_fixed.html" class="nav-link ">--}}
                            {{--<span class="title">Fixed Sidebar Layout</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_sidebar_closed.html" class="nav-link ">--}}
                            {{--<span class="title">Closed Sidebar Layout</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="nav-item  ">--}}
                {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                    {{--<i class=" icon-wrench"></i>--}}
                    {{--<span class="title">Custom Layouts</span>--}}
                    {{--<span class="arrow"></span>--}}
                {{--</a>--}}
                {{--<ul class="sub-menu">--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_disabled_menu.html" class="nav-link ">--}}
                            {{--<span class="title">Disabled Menu Links</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_full_height_portlet.html" class="nav-link ">--}}
                            {{--<span class="title">Full Height Portlet</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="layout_full_height_content.html" class="nav-link ">--}}
                            {{--<span class="title">Full Height Content</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}


            <li class="heading">
                <h3 class="uppercase">User</h3>
            </li>

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-users')}}" class="nav-link ">
                            <i class="icon-user"></i>
                            <span class="title">All Users</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-tawk-to-users')}}" class="nav-link ">
                            <i class="icon-user-female"></i>
                            <span class="title">Tawk.To User</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="heading">
                <h3 class="uppercase">Hiring Process</h3>
            </li>

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Hiring Process</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-job-application')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">Job Application</span>
                        </a>
                    </li>


                </ul>
            </li>

            <li class="heading">
                <h3 class="uppercase">Logout</h3>
            </li>

            <li class="nav-item  ">
                <a href="{{route('logout')}}" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span>

                </a>

            </li>
        </ul>

    </div>

</div>