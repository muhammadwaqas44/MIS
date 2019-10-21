@extends('admin-layout.app')
@section('title', "All Job Applications")
@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Job Applications Table</span>
                    </div>
                </div>
                @if(Session::has('message') && Session::has('alert'))
                    <div class="alert {{ session('alert') }}" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('message') }}
                    </div>
                @endif
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{route('admin.add-job-application')}}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <a href="{{route('admin.all-schedules-not-available')}}"
                                       class="btn green  btn-outline">Not Connected</a> &nbsp;&nbsp;&nbsp;
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="{{route('admin.export-all-added-applicants')}}">
                                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                        </li>
                                        {{--<li>--}}
                                            {{--<a href="javascript:;">--}}
                                                {{--<i class="fa fa-file-pdf-o"></i> Save as PDF </a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="javascript:;">--}}
                                                {{--<i class="fa fa-file-excel-o"></i> Export to Excel </a>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="table-toolbar">

                        <div id="sample_1_filter" class="dataTables_filter">
                            <label>Search:</label>
                            <form>
                                <input type="search" placeholder="Search..." name="search_title"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_title'))) value="{{app('request')->input('search_title')}}" @endif>

                                <select id="channel" name="channel_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Channel</option>
                                    @foreach( $data['channels'] as  $channel)
                                        <option value="{{$channel->id}}">
                                            {{$channel->name}}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="channel" name="designation_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Position</option>
                                    @foreach( $data['designation'] as  $designation)
                                        <option value="{{$designation->id}}">
                                            {{$designation->name}}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="channel" name="experience_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Experience</option>
                                    @foreach( $data['experience'] as  $experience)
                                        <option value="{{$experience->id}}">
                                            {{$experience->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="submit" value="Search" class="btn btn-sm green">
                            </form>

                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="sample_1">
                            <thead>
                            <tr>
                                <th> Id</th>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Phone</th>
                                <th> Skype ID</th>
                                <th> Expected Salary</th>
                                <th> Channel</th>
                                <th> Position</th>
                                <th> Experience</th>
                                <th> Apply For</th>
                                <th> Resume</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['allJobApplications'] ['allJobApplications'] as $jobApplication)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$jobApplication->applicant->id}} </td>
                                    <td> {{$jobApplication->applicant->name}}</td>
                                    <td>
                                        <a href="mailto:{{$jobApplication->applicant->email}}"> {{$jobApplication->applicant->email}}</a>
                                    </td>
                                    <td class="center">{{$jobApplication->applicant->user_phone}}</td>

                                    <td class="center">{{$jobApplication->applicant->skype_id}}</td>
                                    <td class="center">{{$jobApplication->applicant->expected_salary}}</td>
                                    @if($jobApplication->applicant->channel_id)
                                        <td class="center">{{$jobApplication->applicant->channel->name}}</td>
                                    @else
                                        <td class="center">No Channel</td>
                                    @endif
                                    @if($jobApplication->applicant->designation_id)
                                        <td class="center">{{$jobApplication->applicant->designation->name}}</td>
                                    @else
                                        <td class="center">No Designation</td>
                                    @endif

                                    @if($jobApplication->applicant->experience_id)
                                        <td class="center">{{$jobApplication->applicant->experience->name}}</td>
                                    @else
                                        <td class="center">No Experience</td>
                                    @endif

                                    <td class="center"> @if(isset($jobApplication->applicant->apply_for)){{ $jobApplication->applicant->apply_for}}@endif</td>
                                    <td class="center">
                                        <a target="_blank"
                                           href="{{route('admin.download-resume',$jobApplication->applicant->id)}}">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Resume</button>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">

                                                <li>
                                                    <a href="{{route('admin.edit-job-application',$jobApplication->applicant->id)}}">
                                                        <i class="icon-user"></i> View </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('admin.add-status-application',$jobApplication->applicant->id)}}">
                                                        <i class="icon-tag"></i> Add </a>
                                                </li>
                                            </ul>


                                            <div class="modal fade bs-modal-lg"
                                                 id="myModalApplication2_{{$jobApplication->applicant->id}}"
                                                 tabindex="-1" role="dialog" style="width: auto">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->


                                                    <div class="portlet light ">
                                                        <div class="portlet-title tabbable-line">
                                                            <div class="caption caption-md">
                                                                <i class="icon-globe theme-font hide"></i>
                                                                <span class="caption-subject font-blue-madison bold uppercase">Interview Schedule</span>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="tab-content">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- //Modal content-->
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">

                        <div class="col-md-7 col-sm-7">
                            <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
                                {{$data['allJobApplications'] ['allJobApplications']->links()}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection