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
                        <span class="caption-subject bold uppercase">Next Review</span>
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
                                        <h5>Name : {{$employee->first_name}}{{$employee->last_name}}</h5>
                                        <h5>Email : {{$employee->email}}</h5>
                                        <h5>Mobile Number : {{$employee->mobile_number}}</h5>
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
                                <form method="post" action="{{route('admin.next-review-upcoming-employee-post',$employee->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$employee->job_id}}" name="job_id">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Add Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($data['callStatus'] as $callStatus)
                                                            <option value="{{$callStatus->id}}">{{$callStatus->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Due On</label>
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="date_of_birth" placeholder="Due On"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <label>Commitment</label>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <textarea type="text" name="remarks" class="form-control" rows="4"
                                                              placeholder="Commitment"></textarea>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button TYPE="submit" class="btn green-dark">Save</button>
                                            <button class="btn btn-outline-info">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
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