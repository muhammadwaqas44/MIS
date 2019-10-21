<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">


            <li class="nav-item start">
                <a href="{{route('admin-dashboard')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>

            </li>
            @if(Auth::user()->role->user_int ==1)
                <li @if(Request::route()->getName() == 'admin.all-users') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-user') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-tawk-to-users') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.update-account') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-winners') class="nav-item active open"
                    @else class="nav-item " @endif >
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">User</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{route('admin.all-users')}}" class="nav-link">
                                <i class="icon-user"></i>
                                <span class="title">All Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-tawk-to-users')}}" class="nav-link">
                                <i class="icon-user"></i>
                                <span class="title">Tawk.To User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-winners')}}" class="nav-link">
                                <i class="icon-user"></i>
                                <span class="title">Winners</span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif
            @if(Auth::user()->role->hiring_int == 1)
                <li @if(Request::route()->getName() == 'admin.all-job-application') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-job-application') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.edit-job-application') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-status-application') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-schedules') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-schedules-not-available') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.change-schedule-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-status-interview') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-status-not-interview') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-interviews') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.shortlisted') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.tech-interview') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.hr-interview') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.offer-given') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-applicants') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.export-job-applicant') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-initial-interview-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.download-offer-latter') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-shortlisted-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-shortlisted-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-tech-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-tech-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-hr-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-hr-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-offer-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-offer-status') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-all-app-status') class="nav-item active open"
                    @else class="nav-item " @endif >
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
                        <li class="nav-item">
                            <a href="{{route('admin.all-schedules')}}" class="nav-link ">
                                <i class="icon-paper-clip"></i>
                                <span class="title">Interview Schedules</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-interviews')}}" class="nav-link ">
                                <i class="icon-paper-clip"></i>
                                <span class="title">Initial Interviews</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.shortlisted')}}" class="nav-link ">
                                <i class="icon-paper-clip"></i>
                                <span class="title">Shortlisted</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.tech-interview')}}" class="nav-link ">
                                <i class="icon-paper-clip"></i>
                                <span class="title">Technical Evaluation</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.hr-interview')}}" class="nav-link ">
                                <i class="icon-paper-clip"></i>
                                <span class="title">HR Interviews</span>
                            </a>
                        </li>
                        <li class="nav-item">
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
                        <li class="nav-item">
                            <a href="{{route('admin.all-applicants')}}" class="nav-link ">
                                <i class="icon-paper-clip"></i>
                                <span class="title">All Applicants</span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif
            @if(Auth::user()->role->emp_int ==1)
                <li @if(Request::route()->getName() == 'admin.all-employees') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-active-inActive-employees') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-employee') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.join-employee') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.update-employee-view') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.status-employee-view') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.change-employee-active') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-upcoming-reviews-employment') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.status-employee-review') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.next-review-employee') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-employment-check-list') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-employment-check-list-page') class="nav-item active open"
                    @else class="nav-item " @endif >
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-briefcase"></i>
                        <span class="title">Employment</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.all-employees')}}" class="nav-link">
                                <i class="icon-briefcase"></i>
                                <span class="title">Employees</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-upcoming-reviews-employment')}}" class="nav-link">
                                <i class="icon-briefcase"></i>
                                <span class="title">Upcoming Reviews</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-employment-check-list')}}" class="nav-link">
                                <i class="icon-briefcase"></i>
                                <span class="title">Check List Report</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->role->sms_int ==1)
                <li @if(Request::route()->getName() == 'admin.all-message-responses') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-messages') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.change-message-status') class="nav-item active open"
                    @else class="nav-item " @endif >
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-envelope"></i>
                        <span class="title">SMS</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{route('admin.all-messages')}}" class="nav-link">
                                <i class="icon-envelope"></i>
                                <span class="title">All Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-message-responses')}}" class="nav-link">
                                <i class="icon-envelope"></i>
                                <span class="title">All SMS Response</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->role->vendor_int ==1)
                <li @if(Request::route()->getName() == 'admin.all-vendors') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-vendor') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.update-vendor-view') class="nav-item active open"
                    @else class="nav-item " @endif >
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-badge"></i>
                        <span class="title">Vendors</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{route('admin.all-vendors')}}" class="nav-link">
                                <i class="icon-badge"></i>
                                <span class="title">Vendors</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->role->content_int ==1)
                <li @if(Request::route()->getName() == 'admin.all-ideas') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-idea') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.edit-idea') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-plans') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.edit-plan') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.edit-plan-post-update') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.download-source-file') class="nav-item active open"
                    @elseif(Request::route()->getName() =='admin.produce-plan') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.platform-page') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-content-generation') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-seo') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-content-generation-view') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.seo-view') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-review') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-review-view') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.platform-seo') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.platform-process') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-publish') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-publish-view') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-contents') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.platform-publish') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.platform-review') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-published') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.all-published-view') class="nav-item active open"
                    @else class="nav-item " @endif >
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-anchor"></i>
                        <span class="title">CMT</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.all-ideas')}}" class="nav-link ">
                                <i class="icon-anchor"></i>
                                <span class="title">ideas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-plans')}}" class="nav-link ">
                                <i class="icon-anchor"></i>
                                <span class="title">Plans</span>
                            </a>
                        </li>
                        <li @if(Request::route()->getName() == 'admin.all-content-generation') class="nav-item active open"
                            @elseif(Request::route()->getName() == 'admin.all-content-generation-view') class="nav-item active open"
                            @elseif(Request::route()->getName() == 'admin.all-seo') class="nav-item active open"
                            @elseif(Request::route()->getName() == 'admin.platform-seo') class="nav-item active open"
                            @elseif(Request::route()->getName() == 'admin.platform-process') class="nav-item active open"
                            @elseif(Request::route()->getName() == 'admin.seo-view') class="nav-item active open"
                            @else class="nav-item " @endif>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-anchor"></i>
                                <span class="title">Process Content</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="{{route('admin.all-content-generation')}}" class="nav-link ">
                                        <i class="icon-anchor"></i>
                                        <span class="title">Content</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.all-seo')}}" class="nav-link ">
                                        <i class="icon-anchor"></i>
                                        <span class="title">SEO</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-review')}}" class="nav-link ">
                                <i class="icon-anchor"></i>
                                <span class="title">Review</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.all-publish')}}" class="nav-link ">
                                <i class="icon-anchor"></i>
                                <span class="title">Ready to Publish</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-published')}}" class="nav-link">
                                <i class="icon-anchor"></i>
                                <span class="title">Published</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.all-contents')}}" class="nav-link ">
                                <i class="icon-anchor"></i>
                                <span class="title">All Contents</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->role->inventory_int ==1)
                <li @if(Request::route()->getName() == 'admin.all-inventories') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-inventory') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.edit-inventory') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-inventory') class="nav-item active open"
                    @else class="nav-item " @endif >
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-earphones-alt"></i>
                        <span class="title">Inventory</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.all-inventories')}}" class="nav-link">
                                <i class="icon-earphones-alt"></i>
                                <span class="title">All Inventories</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->role->exp_int ==1)
                <li @if(Request::route()->getName() == 'admin.all-expenses') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.add-expense') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-expense') class="nav-item active open"
                    @elseif(Request::route()->getName() == 'admin.view-inventory') class="nav-item active open"
                    @else class="nav-item " @endif>
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-badge"></i>
                        <span class="title">Expenses</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.all-expenses')}}" class="nav-link">
                                <i class="icon-badge"></i>
                                <span class="title">All Expenses</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="nav-item  ">
                <a href="{{route('logout')}}" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span>

                </a>

            </li>
        </ul>

    </div>

</div>