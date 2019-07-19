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
                            <i class="icon-user"></i>
                            <span class="title">Tawk.To User</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-winners')}}" class="nav-link ">
                            <i class="icon-user"></i>
                            <span class="title">Winners</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-paper-clip"></i>
                    <span class="title">Hiring</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-job-application')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">Job Applications</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-schedules')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">Interview Schedules</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-interviews')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">Initial Interviews</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.shortlisted')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">Shortlisted</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.tech-interview')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">Technical Evaluation</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.hr-interview')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">HR Interviews</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.offer-given')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">Offer Given</span>
                        </a>
                    </li>
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="{{route('admin.all-interviews')}}" class="nav-link ">--}}
                            {{--<i class="icon-paper-clip"></i>--}}
                            {{--<span class="title">Joining</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-applicants')}}" class="nav-link ">
                            <i class="icon-paper-clip"></i>
                            <span class="title">All Applicants</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Employment</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-employees')}}" class="nav-link ">
                            <i class="icon-briefcase"></i>
                            <span class="title">All Employees</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-envelope"></i>
                    <span class="title">SMS Response</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{route('admin.all-message-responses')}}" class="nav-link ">
                            <i class="icon-envelope"></i>
                            <span class="title">All SMS Response</span>
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