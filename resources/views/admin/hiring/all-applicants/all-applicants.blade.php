@extends('admin-layout.app')
@section('title', "All Applicant History")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">All Applicant History </span>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="{{route('admin.export-job-applicant')}}">
                                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-toolbar">

                        <div id="sample_1_filter" class="dataTables_filter">
                            <label>Search:</label>
                            <form>
                                <input type="search" placeholder="Search ..." name="search_title"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_title'))) value="{{app('request')->input('search_title')}}" @endif>
                                &nbsp;
                                <span class="input-append date form_datetime1">
                                                <input type="text" name="date1" readonly
                                                       class="form-control input-sm input-small input-inline"
                                                       placeholder="Form Date ..">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                            </span>
                                <span class="input-append date form_datetime1">
                                                <input size="16" type="text" name="date2" readonly
                                                       class="form-control input-sm input-small input-inline"
                                                       placeholder="To Date ..">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                            </span>


                                <select id="channel" name="designation_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Position</option>
                                    @foreach( $data['designation'] as  $designation)
                                        <option value="{{$designation->id}}">
                                            {{$designation->name}}
                                        </option>
                                    @endforeach
                                </select>


                                <select id="channel" name="status_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Status</option>
                                    @foreach( $data['statuses'] as  $designation)
                                        <option value="{{$designation->id}}">
                                            {{$designation->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="submit" value="Search" class="btn btn-sm green">
                            </form>

                        </div>


                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" style=""
                               id="sample_1">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Applicant Phone</th>
                                <th> Skype ID</th>
                                <th> Expected Salary</th>
                                <th> Address</th>
                                <th> City</th>
                                <th> Status</th>
                                <th> Channel</th>
                                <th> Position</th>
                                <th> Experience</th>
                                <th> Remarks</th>
                                <th> Apply For</th>
                                <th> Updated By</th>
                                <th> Updated At</th>
                                <th> Resume</th>

                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['allApplicants']['allApplicants'] as $interview)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$interview->applicant->id}}</td>
                                    <td> {{$interview->applicant->name}}</td>
                                    <td>
                                        <a href="mailto:{{$interview->applicant->email}}"> {{$interview->applicant->email}}</a>
                                    </td>

                                    <td class="center">{{$interview->applicant->user_phone}}</td>
                                    <td class="center">{{$interview->applicant->skype_id}}</td>
                                    <td class="center">{{$interview->applicant->expected_salary}}</td>
                                    <td class="center">{{$interview->applicant->address}}</td>
                                    <td class="center">{{$interview->applicant->city_name}}</td>
                                    @if(isset($interview->status))
                                        <td class="center">{{$interview->status->name}}</td>
                                    @else
                                        <td class="center">None</td>
                                    @endif
                                    <td class="center"> {{ $interview->applicant->channel->name}}</td>
                                    <td class="center"> {{ $interview->applicant->designation->name}}</td>
                                    <td class="center"> {{ $interview->applicant->experience->name}}</td>

                                    <td class="center"> {{ $interview->remarks}}</td>
                                    <td class="center"> @if(isset($interview->applicant->apply_for)){{ $interview->applicant->apply_for}}@endif</td>
                                    @if(isset($interview->user))
                                        <td class="center">{{$interview->user->first_name}} {{$interview->user->last_name}}</td>
                                    @else
                                        <td class="center"> None</td>
                                    @endif
                                    <td class="center">{{$interview->created_at}}</td>
                                    <td class="center"><a target="_blank"
                                                href="{{route('admin.download-resume',$interview->applicant->id)}}">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Resume</button>
                                        </a></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">

                                                <li>
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#editInterview_{{$interview->id}}">
                                                        <i class="icon-user"></i> View </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#myModalApplication2_{{$interview->id}}">
                                                        <i class="icon-tag"></i> Add  </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('admin.join-employee',$interview->id)}}">
                                                        <i class="icon-user"></i> Join</a>
                                                </li>
                                            </ul>

                                            <div class="modal fade bs-modal-lg"
                                                 id="myModalApplication2_{{$interview->id}}"
                                                 tabindex="-1" role="dialog" style="width: auto">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->


                                                    <div class="portlet light ">
                                                        <div class="portlet-title tabbable-line">
                                                            <div class="caption caption-md">
                                                                <i class="icon-globe theme-font hide"></i>
                                                                <span class="caption-subject font-blue-madison bold uppercase">Interviews Schedule</span>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="tab-content">
                                                                <form id="myformSchedule"
                                                                      action="{{route('admin.update-interview-schedule-all',$interview->id)}}"
                                                                      method="post"
                                                                      enctype="multipart/form-data">
                                                                    @csrf


                                                                    <div class="form-group">
                                                                        <input hidden
                                                                               name="job_id"
                                                                               value="{{$interview->applicant->id}}"
                                                                        />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label class="control-label">Name
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$interview->applicant->name}}"/>
                                                                            </div>
                                                                            @if($interview->applicant->designation_id)
                                                                                <div class="col-md-4">
                                                                                    <label class="control-label">Position
                                                                                        :</label>
                                                                                    <input readonly
                                                                                           style="background: none; border: none"
                                                                                           value="{{$interview->applicant->designation->name}}"
                                                                                    />
                                                                                </div>
                                                                            @endif
                                                                            <div class="col-md-4">
                                                                                <label class="control-label"> Email
                                                                                    Notification
                                                                                    :</label>
                                                                                <input type="checkbox" name="emailSend"
                                                                                       value="1" CHECKED
                                                                                       class="checkbox-inline">
                                                                                {{--<label style="padding: 2px;"><input type="file" style="display: none;"--}}
                                                                                                                    {{--name="file_attach"--}}
                                                                                                                    {{--class="form-control"><i class="icon-paper-clip"></i></label>--}}
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label class="control-label">Email
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none; width: 75%"
                                                                                       value="{{$interview->applicant->email}}"/>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label class="control-label">Phone
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$interview->applicant->user_phone}}"/>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                @if($interview->applicant->city_name)
                                                                                    <label class="control-label">City
                                                                                        :</label>
                                                                                    <input readonly
                                                                                           style="background: none; border: none"
                                                                                           value="{{$interview->applicant->city_name}}"/>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                @if($interview->applicant->address)
                                                                                    <label class="control-label">Address
                                                                                        :</label>
                                                                                    <input readonly
                                                                                           style="background: none; border: none;width: 80%"
                                                                                           value="{{$interview->applicant->address}}"/>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Conneted
                                                                                    Call
                                                                                    Status</label>
                                                                                <select id="callStatus" name="call_id"
                                                                                        class="form-control callStatusSub">
                                                                                    <option value="">Select Call Status
                                                                                    </option>
                                                                                    @foreach($data['callStatus'] as  $callStatus)
                                                                                        <option value="{{$callStatus->id}}">
                                                                                            {{$callStatus->name}}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Date
                                                                                    Time</label>
                                                                                <div class="input-append date form_datetime">
                                                                                    <input size="16" type="text"
                                                                                           autocomplete="off"
                                                                                           name="dateTime"
                                                                                           class="form-control dateTime">
                                                                                    <span class="add-on"><i
                                                                                                class="icon-remove"></i></span>
                                                                                    <span class="add-on"><i
                                                                                                class="icon-th"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Remarks</label>
                                                                        <textarea name="remarks"
                                                                                  class="form-control"
                                                                                  rows="2"></textarea>
                                                                    </div>
                                                                    <div class="margiv-top-10">

                                                                        <button type="submit" id="button1"
                                                                                class="btn green">
                                                                            Save
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn red"
                                                                                data-dismiss="modal">
                                                                            Cancel
                                                                        </button>

                                                                    </div>
                                                                </form>
                                                                <br>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover"
                                                                           id="sample_1">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Id</th>
                                                                            <th> Name</th>
                                                                            <th> Status</th>
                                                                            <th> Position</th>
                                                                            <th> Date & Time</th>
                                                                            <th> Remarks</th>
                                                                            <th> Updated by</th>
                                                                            <th> Updated At</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($data['updatedInterviews']->where('job_id', '=', $interview->applicant->id) as $updatedSchedule)
                                                                            <tr class="odd gradeX">
                                                                                <td class="center"> {{$updatedSchedule->id}} </td>
                                                                                <td> {{$updatedSchedule->applicant->name}}</td>
                                                                                @if(isset($updatedSchedule->status->name))
                                                                                    <td class="center">{{$updatedSchedule->status->name}}</td>
                                                                                @else
                                                                                    <td class="center">No Status</td>
                                                                                @endif
                                                                                <td class="center">{{$updatedSchedule->applicant->designation->name}}</td>
                                                                                <td class="center">{{$updatedSchedule->dateTime}}</td>
                                                                                <td class="center">{{$updatedSchedule->remarks}}</td>
                                                                                <td class="center">@if(isset($updatedSchedule->user)){{$updatedSchedule->user->first_name}} {{$updatedSchedule->user->last_name}} @endif </td>
                                                                                <td class="center">{{$updatedSchedule->created_at}}</td>

                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- //Modal content-->
                                                </div>
                                            </div>
                                            <div class="modal fade  bs-modal-lg" id="editInterview_{{$interview->id}}"
                                                 tabindex="-1" role="dialog" style="width: auto">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->


                                                    <div class="portlet light ">
                                                        <div class="portlet-title tabbable-line">
                                                            <div class="caption caption-md">
                                                                <i class="icon-globe theme-font hide"></i>
                                                                <span class="caption-subject font-blue-madison bold uppercase">{{$interview->applicant->name}}
                                                                    History</span>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="tab-content">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover"
                                                                           id="sample_1">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Id</th>
                                                                            <th> Name</th>
                                                                            <th> Status</th>
                                                                            <th> Position</th>
                                                                            <th> Date & Time</th>
                                                                            <th> Remarks</th>
                                                                            <th> Updated by</th>
                                                                            <th> Updated At</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach( $data['updatedInterviews']->where('job_id', '=', $interview->applicant->id) as $updatedInterviews)
                                                                            <tr class="odd gradeX">
                                                                                <td class="center"> {{$updatedInterviews->id}} </td>
                                                                                <td> {{$updatedInterviews->applicant->name}}</td>
                                                                                @if(isset($updatedInterviews->status->name))
                                                                                    <td class="center">{{$updatedInterviews->status->name}}</td>
                                                                                @else
                                                                                    <td class="center">No Status</td>
                                                                                @endif
                                                                                <td class="center">{{$updatedSchedule->applicant->designation->name}}</td>
                                                                                <td class="center">{{$updatedInterviews->dateTime}}</td>
                                                                                <td class="center">{{$updatedInterviews->remarks}}</td>
                                                                                <td class="center">@if(isset($updatedInterviews->user)){{$updatedInterviews->user->first_name}} {{$updatedInterviews->user->last_name}} @endif </td>
                                                                                <td class="center">{{$updatedInterviews->created_at}}</td>

                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
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
                                {{$data['allApplicants']['allApplicants']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>


    <script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <script src="{{asset('assets-admin/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets-admin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">

        $(".form_datetime1").datepicker({
            format: "dd MM yyyy",
            showMeridian: false,
            autoclose: true,
            todayBtn: true
        });
        $(".form_datetime").datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            autoclose: true,
            todayBtn: true
        });
    </script>

@endsection