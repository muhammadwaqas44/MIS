@extends('admin-layout.app')
@section('title', "Add")
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Hiring
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Initial Interview
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Add
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
                                <form
                                        action="{{route('admin.post-add-interview-data',$interview->id)}}"
                                        method="post" id="myformSchedule"
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
                                                <label class="control-label">
                                                    Email Notification :
                                                </label>
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
                                                           value="{{$interview->applicant->address}}"
                                                           rows="2"/>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">
                                                    Call Status</label>
                                                <select name="call_id" id="callStatusSub"
                                                        class="form-control ">
                                                    <option value="{{$interview->status->id}}">{{$interview->status->name}}</option>
                                                    @foreach($data['interviewStatus'] as  $interviewStatus)
                                                        <option value="{{$interviewStatus->id}}">
                                                            {{$interviewStatus->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="error2" style="color: red;"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Date
                                                    Time</label>
                                                <div class="input-append date form_datetime">
                                                    <input size="16" type="text"
                                                           autocomplete="off"
                                                           value="{{$interview->dateTime}}"
                                                           name="dateTime" id="dateTime"
                                                           class="form-control">
                                                    <span class="add-on"><i
                                                                class="icon-remove"></i></span>
                                                    <span class="add-on"><i
                                                                class="icon-th"></i></span>
                                                    <span id="error1" style="color: red;"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Remarks</label>
                                        <textarea name="remarks"
                                                  class="form-control"
                                                  rows="2">{{$interview->remarks}}</textarea>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-2">

                                            <button type="button" id="button1"
                                                    class="btn green">
                                                Save
                                            </button>
                                            <a href="{{route('admin.all-interviews')}}">
                                                <button type="button"
                                                        class="btn red">
                                                    Cancel
                                                </button>
                                            </a>
                                        </div>


                                        <div class="col-md-6" id="attach"
                                             @if($interview->call_id != 14 ) style="display: none;" @endif>

                                            <span class='label' id="upload-file-info1" style="color: darkgreen; display: none;
    position: absolute;"> <h4><b>Offer latter  attached</b></h4></span>

                                            @if($interview->applicant->joining_latter != null)
                                                <span class='label' id="upload-file-info4" style="color: darkgreen;
    position: absolute;"> <h4><b>Offer latter attached</b></h4></span>
                                            @else
                                                <span class='label' id="upload-file-info2" style="position: absolute;
     color: darkred;"><h4><b>Please attach an offer latter</b></h4> </span>
                                            @endif


                                            <span class='label' id="upload-file-info3" style="
     color: darkgreen; display: none;
    position: absolute;"> </span>
                                        </div>

                                        <div class="col-md-4" id="comp"
                                             @if($interview->call_id != 14 ) style="display: none;" @endif>
                                            <label class="btn pull-right"
                                                   style=" color:#fff;border-radius: 3px;border: 1px solid green;padding: 6px 20px; background-color: green; for= "
                                                   file_attach">
                                            <input id="file_attach" type="file" name="file_attach" class="form-control"
                                                   style="display:none"
                                                   onchange="$('#upload-file-info3').html('<h4><b>Offer latter uploaded</b></h4>');
                                                   $('#upload-file-info3').show();
                                                   $('#upload-file-info1').hide();
                                                   $('#upload-file-info2').hide();
                                                    $('#upload-file-info4').hide();
">
                                            Upload Offer
                                            </label>

                                            <a href="#" data-toggle="modal" class="btn red pull-right"
                                               data-target="#editInterview_{{$interview->id}}">
                                                Compose Offer </a>

                                            <a class="btn pull-right" id="file_download"
                                               @if($interview->applicant->joining_latter) style="color: white; background-color: green"
                                               @else style="color: white; background-color: green; display: none" @endif
                                               href="{{route('admin.download-offer-latter',$interview->applicant->id)}}"
                                               alt="{{$interview->applicant->joining_latter}}">
                                                <i class="icon-paper-clip"></i>
                                            </a>

                                        </div>
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
                                                @if($updatedInterviews->call_id)
                                                    <td class="center">{{$updatedInterviews->status->name}}</td>
                                                @else
                                                    <td class="center">No Status</td>
                                                @endif
                                                <td class="center">{{$updatedInterviews->applicant->designation->name}}</td>
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
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- Model For Compose Offer-->
    <div class="modal fade comp_model bs-modal-md" id="editInterview_{{$interview->id}}"
         tabindex="-1" role="dialog" style="width: auto">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->


            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Compose Offer Latter</span>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <form id="comp_form"
                              {{--action="{{route('admin.offer-latter-compose',$interview->id)}}"--}}
                              {{--method="post"--}}
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

                                    <div class="col-md-12">
                                        <label class="control-label">Offer Joining Date</label>
                                        <div class="input-append date form_datetime">
                                            <input size="16" type="text"
                                                   autocomplete="off"
                                                   name="date"
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
                                <label class="control-label">Salary/Probation</label>
                                <input type="text" class="form-control"
                                       name="salary_probation">
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
    <!-- END Model For Compose Offer-->



    <script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/jquery-validation/js/jquery.validate.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <script src="{{asset('assets-admin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            autoclose: true,
            todayBtn: true
        });
        $(function () {
            $('#comp_form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/admin/offer-latter-compose',
                    data: $('form').serialize(),
                    success: function (data) {
                        var date = data.data.date;
                        $("#myformSchedule").find('#dateTime').val(date);
                        $(".comp_model").modal('hide');
                        $("#file_download").show();
                        $('#yourDiv').append('whatever you want');
                        $('#upload-file-info3').hide();
                        $('#upload-file-info4').hide();
                        $('#upload-file-info1').show();
                        $('#upload-file-info2').hide();
                        alert('Offer Composed Successfully');
                    }
                });

            });
        });
        $(document).ready(function () {
            $("#button1").click(function () {
                var call_id = $(this).parents('#myformSchedule').find('#callStatusSub').val();
                var dateTime = $(this).parents('#myformSchedule').find('#dateTime').val();
                if (call_id != '') {
                    if (call_id == 14) {
                        if (dateTime == '') {
                            $("#myformSchedule").find('#error1').text('Please Enter Date Time');
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
        $(document).ready(function () {
            $('#callStatusSub').change(function () {
                var call_id = $(this).parents('#myformSchedule').find('#callStatusSub').val();
//                alert(call_id);
                if (call_id == 14) {
                    $("#comp").show();
                    $("#attach").show();
                } else {
                    $("#comp").hide();
                    $("#attach").hide();
                }
            });
        });

    </script>
@endsection