@extends('admin-layout.app')
@section('title', "View")
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Hiring
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Interview Not Schedule
                <i class="fa fa-circle"></i>
            </li>
            <li>
                View
            </li>
        </ul>
    </div>

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Add Status</span>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="myformSchedule"
                                      action="{{route('admin.update-interview-not-schedule',$schedule->id)}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group">
                                        <input hidden
                                               name="job_id"
                                               value="{{$schedule->applicant->id}}"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Name
                                                    :</label>
                                                <input readonly
                                                       style="background: none; border: none"
                                                       value="{{$schedule->applicant->name}}"/>
                                            </div>
                                            @if($schedule->applicant->designation_id)
                                                <div class="col-md-4">
                                                    <label class="control-label">Position
                                                        :</label>
                                                    <input readonly
                                                           style="background: none; border: none"
                                                           value="{{$schedule->applicant->designation->name}}"
                                                    />
                                                </div>
                                            @endif
                                            <div class="col-md-4">
                                                <label class="control-label"> Email Notification
                                                    :</label>
                                                <input type="checkbox" name="emailSend"
                                                       value="1" CHECKED
                                                       class="checkbox-inline">
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
                                                       value="{{$schedule->applicant->email}}"/>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label">Phone
                                                    :</label>
                                                <input readonly
                                                       style="background: none; border: none"
                                                       value="{{$schedule->applicant->user_phone}}"/>
                                            </div>
                                            <div class="col-md-4">
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
                                                @if($schedule->applicant->address)
                                                    <label class="control-label">Address
                                                        :</label>
                                                    <input readonly
                                                           style="background: none; border: none;width: 80%"
                                                           value="{{$schedule->applicant->address}}"  rows="2" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <label class="control-label">Status</label>
                                                <select
                                                        id="callStatus" required
                                                        class="form-control callStatusSub">
                                                    <option value="">Select Call Status
                                                    </option>
                                                    @foreach($data['callStatus']->whereIn('id',[1,2]) as  $callStatus)
                                                        <option value="{{$callStatus->id}}">
                                                            {{$callStatus->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label">Reason</label>
                                                <select name="call_id"
                                                        id="callStatusSub" required
                                                        class="form-control callStatusSub">
                                                    <option value="">First Select Call Status
                                                    </option>
                                                </select>
                                                <span id="error2" style="color: red;"></span>
                                            </div>
                                            @if($schedule->dateTime)
                                                <div class="col-md-4">
                                                    <label class="control-label">Date Time</label>
                                                    <div class="input-append date form_datetime">
                                                        <input size="16"  type="text" autocomplete="off"
                                                               value="{{$schedule->dateTime}}"
                                                               name="dateTime"
                                                               class="form-control dateTime">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-4">
                                                    <label class="control-label">Date Time</label>
                                                    <div class="input-append date form_datetime">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="dateTime"
                                                               class="form-control dateTime">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Remarks</label>
                                        <textarea name="remarks"
                                                  class="form-control"
                                                  rows="2">{{$schedule->remarks}}</textarea>
                                    </div>

                                    <div class="margiv-top-10">

                                        <button type="button" id="button1"
                                                class="btn green">
                                            Save
                                        </button>
                                        <a href="{{route('admin.all-job-application')}}">
                                            <button type="button"
                                                    class="btn red"
                                                    data-dismiss="modal">
                                                Cancel
                                            </button>
                                        </a>
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
                                        @foreach($data['updatedSchedules']->where('job_id', '=', $schedule->applicant->id) as $updatedSchedule)
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
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/jquery-validation/js/jquery.validate.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <script src="{{asset('assets-admin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#button1").click(function () {
                var call_id = $(this).parents('#myformSchedule').find('#callStatusSub').val();
                var dateTime = $(this).parents('#myformSchedule').find('#dateTime').val();
                if (call_id != '') {
                    if (call_id == 3 || call_id == 6) {
                        if (dateTime == '') {
                            $("#myformSchedule").find('#error').text('Please Enter Date Time');
                        } else {
                            $("#myformSchedule").submit();
                        }
                    }
                    else {
//                            alert('okokoook');
                        $("#myformSchedule").submit();
                    }
                } else {
                    $("#myformSchedule").find('#error2').text('Please Select Status');
                }
            });
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