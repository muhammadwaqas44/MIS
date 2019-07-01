@extends('admin-layout.app')
@section('title', "All Schedules")
@section('content')
    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    {{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
    {{--<script>--}}
    {{--$( function() {--}}
    {{--$( "#datepicker" ).datepicker();--}}
    {{--} );--}}
    {{--</script>--}}
    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    {{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
    {{--<script>--}}
    {{--$( function() {--}}
    {{--$( "#datepicker" ).datepicker();--}}
    {{--} );--}}
    {{--</script>--}}

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Schedule Table</span>
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
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> Print </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
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
                                <input type="submit" value="Search" class="btn btn-sm green">
                            </form>

                        </div>


                    </div>

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sample_1">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> Applicant Phone</th>
                            <th> Status</th>
                            <th> Date & Time</th>
                            <th> Remarks</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['allSchedules']['allSchedules'] as $schedule)
                            <tr class="odd gradeX">
                                <td class="center"> {{$schedule->id}} </td>
                                <td> {{$schedule->applicant->name}}</td>
                                <td>
                                    <a href="mailto:{{$schedule->applicant->email}}"> {{$schedule->applicant->email}}</a>
                                </td>

                                <td class="center">{{$schedule->applicant->user_phone}}</td>
                                @if($schedule->call_id)
                                    <td class="center">{{$schedule->status->name}}</td>
                                @else
                                    <td class="center">No Status</td>
                                @endif

                                <td class="center">{{$schedule->dateTime}}</td>
                                <td class="center"> {{ str_limit($schedule->remarks, $limit = 60, $end = '...') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">

                                            <li>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#editSchedule_{{$schedule->id}}">
                                                    <i class="icon-note"></i> View </a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#addInterview_{{$schedule->id}}">
                                                    <i class="icon-note"></i> Add Interview </a>
                                            </li>

                                        </ul>
                                        <div class="modal fade bs-modal-lg" id="editSchedule_{{$schedule->id}}"
                                             tabindex="-1" role="dialog" style="width: auto">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->


                                                <div class="portlet light ">
                                                    <div class="portlet-title tabbable-line">
                                                        <div class="caption caption-md">
                                                            <i class="icon-globe theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Edit Schedule</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <form action="{{route('admin.update-interview-schedule',$schedule->id)}}"
                                                                  method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="form-group">
                                                                    <div class="row">

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input hidden
                                                                           name="job_id"
                                                                           value="{{$schedule->applicant->id}}"
                                                                    />
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Name
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$schedule->applicant->name}}"/>
                                                                        </div>
                                                                        @if($schedule->applicant->designation_id)
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Position
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$schedule->applicant->designation->name}}"
                                                                                />
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Email
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none; width: 75%"
                                                                                   value="{{$schedule->applicant->email}}"/>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Phone
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$schedule->applicant->user_phone}}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            @if($schedule->applicant->address)
                                                                                <label class="control-label">Address
                                                                                    :</label>
                                                                                <textarea readonly class="form-control"
                                                                                          style="background: none; border: none;width: 60%"
                                                                                          rows="2">
                                                                                                {{$schedule->applicant->address}}</textarea>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            @if($schedule->applicant->city_name)
                                                                                <label class="control-label">City
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$schedule->applicant->city_name}}"/>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Call
                                                                                Status</label>
                                                                            <select id="callStatus"
                                                                                    class="form-control">
                                                                                <option value="">Select Call
                                                                                    Status
                                                                                </option>
                                                                                @foreach($data['callStatus']->where('parent_id',null) as  $callStatus)
                                                                                    <option value="{{$callStatus->id}}">
                                                                                        {{$callStatus->name}}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Select
                                                                                Call
                                                                                Status</label>
                                                                            <select name="call_id"
                                                                                    id="callStatusSub"
                                                                                    class="form-control">
                                                                                <option value="{{$schedule->status->id}}">
                                                                                    {{$schedule->status->name}}
                                                                                </option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Time
                                                                                & Date</label>
                                                                            <div class="input-append date form_datetime">
                                                                                <input size="16" type="text"
                                                                                       value="{{$schedule->dateTime}}"
                                                                                       required readonly
                                                                                       name="dateTime"
                                                                                       class="form-control">
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
                                                                              rows="4"
                                                                              required>{{$schedule->remarks}}</textarea>
                                                                </div>
                                                                <div class="margiv-top-10">

                                                                    <button type="submit"
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
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered table-hover"
                                                                       id="sample_1">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Id</th>
                                                                        <th> Name</th>
                                                                        <th> Email</th>
                                                                        <th> Applicant Phone</th>
                                                                        <th> Status</th>
                                                                        <th> Date & Time</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($data['jobApp']->where('id','=',$schedule->job_id) as $job)
                                                                        <tr class="odd gradeX">
                                                                            <td class="center"> {{$job->id}} </td>
                                                                            <td> {{$job->name}}</td>
                                                                            <td>
                                                                                <a href="mailto:{{$job->email}}"> {{$job->email}}</a>
                                                                            </td>

                                                                            <td class="center">{{$job->user_phone}}</td>
                                                                            <td class="center">
                                                                                <a href="{{route('admin.download-resume',$job->id)}}">
                                                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Resume</button>
                                                                                </a>
                                                                            </td>
                                                                            <td class="center">{{$job->created_at}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    @foreach($data['updatedSchedules']->where('job_id', '=', $schedule->applicant->id) as $updatedSchedule)
                                                                        <tr class="odd gradeX">
                                                                            <td class="center"> {{$updatedSchedule->id}} </td>
                                                                            <td> {{$updatedSchedule->applicant->name}}</td>
                                                                            <td>
                                                                                <a href="mailto:{{$updatedSchedule->applicant->email}}"> {{$updatedSchedule->applicant->email}}</a>
                                                                            </td>

                                                                            <td class="center">{{$updatedSchedule->applicant->user_phone}}</td>
                                                                            @if($updatedSchedule->call_id)
                                                                                <td class="center">{{$updatedSchedule->status->name}}</td>
                                                                            @else
                                                                                <td class="center">No Status</td>
                                                                            @endif
                                                                            <td class="center">{{$updatedSchedule->dateTime}}</td>

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
                                        <div class="modal fade bs-modal-lg" id="addInterview_{{$schedule->id}}"
                                             tabindex="-1" role="dialog" style="width: auto">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->


                                                <div class="portlet light ">
                                                    <div class="portlet-title tabbable-line">
                                                        <div class="caption caption-md">
                                                            <i class="icon-globe theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Post Interview Data</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <form action="{{route('admin.post-add-interview-data',$schedule->id)}}"
                                                                  method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="form-group">
                                                                    <div class="row">

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input hidden
                                                                           name="job_id"
                                                                           value="{{$schedule->applicant->id}}"
                                                                    />
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Name
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$schedule->applicant->name}}"/>
                                                                        </div>
                                                                        @if($schedule->applicant->designation_id)
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Position
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$schedule->applicant->designation->name}}"
                                                                                />
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Email
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none; width: 75%"
                                                                                   value="{{$schedule->applicant->email}}"/>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Phone
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$schedule->applicant->user_phone}}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            @if($schedule->applicant->address)
                                                                                <label class="control-label">Address
                                                                                    :</label>
                                                                                <textarea readonly class="form-control"
                                                                                          style="background: none; border: none;width: 60%"
                                                                                          rows="2">
                                                                                                {{$schedule->applicant->address}}</textarea>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            @if($schedule->applicant->city_name)
                                                                                <label class="control-label">City
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$schedule->applicant->city_name}}"/>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Call
                                                                                Status</label>
                                                                            <select name="call_id"
                                                                                    class="form-control">
                                                                                <option value="">Select InterView Status</option>
                                                                                @foreach($data['interviewStatus'] as  $interviewStatus)
                                                                                    <option value="{{$interviewStatus->id}}">
                                                                                        {{$interviewStatus->name}}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Time
                                                                                & Date</label>
                                                                            <div class="input-append date form_datetime">
                                                                                <input size="16" type="text"
                                                                                       required readonly
                                                                                       name="dateTime"
                                                                                       class="form-control">
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
                                                                              rows="4"
                                                                              required></textarea>
                                                                </div>
                                                                <div class="margiv-top-10">

                                                                    <button type="submit"
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
                    <div class="row">

                        <div class="col-md-7 col-sm-7">
                            <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
                                {{$data['allSchedules']['allSchedules']->links()}}
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
    <link rel="stylesheet" type="text/css" href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">    <script src="{{asset('assets-admin/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js')}}"></script>
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

        $('#callStatus').change(function () {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-call-status-list')}}?parent_id=" + id,
                    success: function (res) {
                        if (res) {
                            $("#callStatusSub").empty();
                            $("#callStatusSub").append('<option>Select</option>');
                            $.each(res, function (id, name) {
                                $("#callStatusSub").append('<option value="' + id + '">' + name + '</option>');
                            });
                        } else {
                            $("#callStatusSub").empty();
                        }
                    }
                });
            } else {
                $("#callStatusSub").empty();
            }
        });
    </script>
@endsection