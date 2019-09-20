@extends('admin-layout.app')
@section('title', "Add Employee Status")
@section('content')


    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Upcoming Status</span>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="preview" src="{{asset($employee->profile_image)}}" width="170px"
                                             height="170px">
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Name : {{$employee->first_name}} {{$employee->last_name}}</h5>
                                        <h5>Email : {{$employee->email}}</h5>
                                        <h5>Mobile Number : {{$employee->mobile_number}}</h5>
                                        <h5>Current Address : {{$employee->current_address}}</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Location
                                            : @if(isset($employee->locationName->name)){{$employee->locationName->name}}@endif</h5>
                                        <h5>Department
                                            : @if(isset($employee->departmentName->name)){{$employee->departmentName->name}}@endif</h5>
                                        <h5>Designation
                                            : @if(isset($employee->designationName->name)){{$employee->designationName->name}}@endif</h5>
                                        <h5>Joining Date : {{$employee->joining_date}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{route('admin.add-status-employee-review',$employee->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$employee->job_id}}" name="job_id">
{{--                                    <input type="hidden" value="{{$employee->id}}" name="emp_id">--}}
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Status</label><span style="color:red;">*</span>
                                                    <select name="status" class="form-control" required>
                                                        <option value="">Select</option>
                                                        @foreach($data['callStatus'] as $callStatus)
                                                            <option value="{{$callStatus->id}}">{{$callStatus->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Update From</label><span style="color:red;">*</span>
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off" required
                                                               name="date_of_birth" placeholder="Update From"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <label>Remarks</label>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <textarea type="text" name="remarks" class="form-control" rows="4"
                                                              placeholder="Remarks"></textarea>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button TYPE="submit" class="btn green-dark">Save</button>
                                            <a href="{{ URL::previous() }}">
                                                <button type="button" class="btn btn-outline-info">Cancel</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
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
                            @foreach( $data['empHis']->where('job_id',$employee->applicant->id) as $updatedSchedule)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$updatedSchedule->id}} </td>
                                    <td> @if(isset($updatedSchedule->applicant)){{$updatedSchedule->applicant->name}} @endif</td>
                                    @if(isset($updatedSchedule->status->name))
                                        <td class="center">{{$updatedSchedule->status->name}}</td>
                                    @else
                                        <td class="center">No Status</td>
                                    @endif
                                    <td class="center">@if(isset($updatedSchedule->applicant->designation)){{$updatedSchedule->applicant->designation->name}} @endif</td>
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
    </script>
@endsection