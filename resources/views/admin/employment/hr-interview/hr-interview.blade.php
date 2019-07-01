@extends('admin-layout.app')
@section('title', "All HR Interviews")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">HR Interviews Table </span>
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
                        @foreach($data['allHRInterviews']['allHRInterviews'] as $interview)
                            <tr class="odd gradeX">
                                <td class="center"> {{$interview->id}} </td>
                                <td> {{$interview->applicant->name}}</td>
                                <td>
                                    <a href="mailto:{{$interview->applicant->email}}"> {{$interview->applicant->email}}</a>
                                </td>

                                <td class="center">{{$interview->applicant->user_phone}}</td>
                                @if($interview->call_id)
                                    <td class="center">{{$interview->status->name}}</td>
                                @else
                                    <td class="center">No Status</td>
                                @endif

                                <td class="center">{{$interview->dateTime}}</td>
                                <td class="center"> {{ str_limit($interview->remarks, $limit = 60, $end = '...') }}</td>
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
                                                   data-target="#addDetailsInterview_{{$interview->id}}">
                                                    <i class="icon-user"></i> add Interview Detials</a>
                                            </li>
                                        </ul>
                                        <div class="modal fade bs-modal-lg" id="editInterview_{{$interview->id}}"
                                             tabindex="-1" role="dialog" style="width: auto">
                                            <div class="modal-dialog  modal-lg">
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
                                                            <form action="{{route('admin.post-update-interview-data',$interview->id)}}"
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
                                                                           value="{{$interview->applicant->id}}"
                                                                    />
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Name
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$interview->applicant->name}}"/>
                                                                        </div>
                                                                        @if($interview->applicant->designation_id)
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Position
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$interview->applicant->designation->name}}"
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
                                                                                   value="{{$interview->applicant->email}}"/>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Phone
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$interview->applicant->user_phone}}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            @if($interview->applicant->address)
                                                                                <label class="control-label">Address
                                                                                    :</label>
                                                                                <textarea readonly class="form-control"
                                                                                          style="background: none; border: none;width: 60%"
                                                                                          rows="2">
                                                                                                {{$interview->applicant->address}}</textarea>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-6">
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
                                                                            <label class="control-label">Call
                                                                                Status</label>
                                                                            <select name="call_id"
                                                                                    class="form-control">
                                                                                <option value="{{$interview->status->id}}">{{$interview->status->name}}</option>
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
                                                                                       name="dateTime" value="{{$interview->dateTime}}"
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
                                                                              required>{{$interview->remarks}}</textarea>
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
                                                                    @foreach($data['jobApp']->where('id','=',$interview->job_id) as $job)
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
                                                                    @foreach($data['updatedInterviews']->where('job_id', '=', $interview->applicant->id) as $updatedInterview)

                                                                        <tr class="odd gradeX">
                                                                            <td class="center"> {{$updatedInterview->id}} </td>
                                                                            <td> {{$updatedInterview->applicant->name}}</td>
                                                                            <td>
                                                                                <a href="mailto:{{$updatedInterview->applicant->email}}"> {{$updatedInterview->applicant->email}}</a>
                                                                            </td>

                                                                            <td class="center">{{$updatedInterview->applicant->user_phone}}</td>
                                                                            @if($updatedInterview->call_id)
                                                                                <td class="center">{{$updatedInterview->status->name}}</td>
                                                                            @else
                                                                                <td class="center">No Status</td>
                                                                            @endif
                                                                            <td class="center">{{$updatedInterview->dateTime}}</td>
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
                                        <div class="modal fade bs-modal-lg" id="addDetailsInterview_{{$interview->id}}"
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
                                                            <form action="{{route('admin.post-add-interview-data',$interview->id)}}"
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
                                                                           value="{{$interview->applicant->id}}"
                                                                    />
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Name
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$interview->applicant->name}}"/>
                                                                        </div>
                                                                        @if($interview->applicant->designation_id)
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Position
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$interview->applicant->designation->name}}"
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
                                                                                   value="{{$interview->applicant->email}}"/>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Phone
                                                                                :</label>
                                                                            <input readonly
                                                                                   style="background: none; border: none"
                                                                                   value="{{$interview->applicant->user_phone}}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            @if($interview->applicant->address)
                                                                                <label class="control-label">Address
                                                                                    :</label>
                                                                                <textarea readonly class="form-control"
                                                                                          style="background: none; border: none;width: 60%"
                                                                                          rows="2">
                                                                                                {{$interview->applicant->address}}</textarea>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-6">
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
                                                                            <label class="control-label">Call
                                                                                Status</label>
                                                                            <select name="call_id"
                                                                                    class="form-control">
                                                                                <option value="">.."Select Status"..</option>
                                                                                @foreach($data['interviewStatusAfterInitial'] as  $interviewStatus)
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
                                {{$data['allHRInterviews']['allHRInterviews']->links()}}
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
    </script>
@endsection