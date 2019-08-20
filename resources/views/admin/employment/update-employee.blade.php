@extends('admin-layout.app')
@section('title', "Update Employee")
@section('content')


    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Add Employee</span>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{route('admin.update-employee',$employee->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$employee->job_id}}" name="job_id">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Personal Detail</h4><br>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <label class="control-label">First Name</label><span style="color:red;">*</span>
                                                    <input type="text" name="first_name" class="form-control" required value="{{$employee->first_name}}"
                                                           placeholder="First Name"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                           placeholder="Last Name" value="{{$employee->last_name}}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Data Of Birth</label>
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off" value="{{$employee->date_of_birth}}"
                                                               name="date_of_birth" placeholder="Data Of Birth"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Gender</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="{{$employee->gender}}">{{$employee->gender}}</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Marital Status</label>
                                                    <select class="form-control" name="marital_status">
                                                        <option value="{{$employee->marital_status}}">{{$employee->marital_status}}</option>
                                                        <option value="single">Single</option>
                                                        <option value="married">Married</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">

                                                    <label class="control-label">Father Name</label>
                                                    <input type="text" name="father_name" class="form-control" value="{{$employee->father_name}}"
                                                           placeholder="Father Name"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Nationality</label>
                                                    <select class="form-control" name="nationality">

                                                        <option value="{{$employee->nationality}}">@if(isset($employee->nationalityCountry->name)){{$employee->nationalityCountry->name}}@endif</option>
                                                        @foreach($data['countries'] as $country)
                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">

                                                    <label class="control-label">Nationality Identity Type</label>
                                                    <select class="form-control" name="n_identity_type">
                                                        <option value="{{$employee->n_identity_type}}">{{$employee->n_identity_type}}</option>
                                                        <option value="CNIC">CNIC</option>
                                                        <option value="Passport">Passport</option>
                                                        <option value="Driving License">Driving License</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Nationality Identity No</label>
                                                    <input type="text" name="n_identity_no" class="form-control"
                                                           placeholder="Nationality Identity No" value="{{$employee->n_identity_no}}"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Contact Detail</h4><br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Current Address</label>
                                                    <input type="text" name="current_address" class="form-control"
                                                           placeholder="Address" value="{{$employee->current_address}}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <label class="control-label">Current Country</label>

                                                    <select id="current_country" name="current_country" class="form-control">
                                                        <option value="{{$employee->current_country}}">@if(isset($employee->currentCountry->name)){{$employee->currentCountry->name}}@endif
                                                        </option>
                                                        @foreach($data['countries'] as  $country)
                                                            <option value="{{$country->id}}">
                                                                {{$country->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Current State</label>
                                                    <select name="current_state" id="current_state" class="form-control">
                                                        <option value="{{$employee->current_state}}">@if(isset($employee->currentState->name)){{$employee->currentState->name}}@endif</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="control-label">Current City</label>
                                                    <select name="current_city" id="current_city" class="form-control">
                                                        <option value="{{$employee->current_city}}">@if(isset($employee->currentCity->name)){{$employee->currentCity->name}}@endif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Permanent Address</label>
                                                    <input type="text" name="permanent_address" class="form-control" value="{{$employee->permanent_address}}"
                                                           placeholder="Address"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="control-label">Permanent Country</label>

                                                    <select id="permanent_country" name="permanent_country" class="form-control">
                                                        <option value="{{$employee->permanent_country}}">@if(isset($employee->permanentCountry->name)){{$employee->permanentCountry->name}}@endif
                                                        </option>
                                                        @foreach($data['countries'] as  $country)
                                                            <option value="{{$country->id}}">
                                                                {{$country->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Permanent State</label>
                                                    <select name="permanent_state" id="permanent_state" class="form-control">
                                                        <option value="{{$employee->permanent_state}}">@if(isset($employee->permanentState->name)){{$employee->permanentState->name}}@endif</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="control-label">Permanent City</label>
                                                    <select name="permanent_city" id="permanent_city" class="form-control">
                                                        <option value="{{$employee->permanent_city}}">@if(isset($employee->permanentCity->name)){{$employee->permanentCity->name}}@endif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Mobile Number</label><span style="color:red;">*</span>
                                                    <input type="text" name="mobile_number" class="form-control"
                                                           placeholder="Mobile Number" required value="{{$employee->mobile_number}}"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Secondary Number</label>
                                                    <input type="text" name="secondary_number" class="form-control"
                                                           placeholder="Phone Number" value="{{$employee->secondary_number}}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Skype ID</label>
                                                    <input type="text" name="skype_id" class="form-control"
                                                           placeholder="Skype ID" value="{{$employee->skype_id}}"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Email</label><span style="color:red;">*</span>
                                                    <input type="email" name="email" class="form-control"
                                                           placeholder="Email" required value="{{$employee->email}}"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Photo</h4><br>
                                            <div class="text-center"
                                                 style="width: 233px;display: inline-block;border: 1px solid #F2F2F2;background-color: #F9F9F9;position: relative;height: 233px;">
                                                <img id="preview" src="{{asset($employee->profile_image)}}" width="233px"
                                                     height="233px">
                                            </div>
                                            <input type="file" name="profile_image"  value="{{$employee->profile_image}}" id="fileUploader" style="margin-top: 10px;">
                                            <input type="hidden" name="profile_image_hide"  value="{{$employee->profile_image}}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4> Employee Personal Documents</h4><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Resume</label>
                                                    @if($employee->employeePersonalDocument)
                                                        @foreach($employee->employeePersonalDocument()->where('type','=','resume')->get() as $item)
                                                            <a href="{{route('admin.download-resume-employee',$item->id)}}"
                                                               target="_blank"><i class="fa fa-file"></i>
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                    <input type="file" class="form-control" name="resume" @if(isset($employee->employeePersonalDoc->resume)) value="{{$employee->employeePersonalDoc->resume}}"@endif/>
                                                    <input type="hidden"  name="resume_hide" @if(isset($employee->employeePersonalDoc->resume)) value="{{$employee->employeePersonalDoc->resume}}" @endif/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>ID Proof</label>
                                                    <input type="file" class="form-control" name="id_proof[]" multiple @if(isset($employee->employeePersonalDoc->id_proof)) value="{{$employee->employeePersonalDoc->id_proof}}" @endif/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Other Documents</label>
                                                    <input type="file" class="form-control" name="other_doc_personal[]" multiple/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4> Employee Official Documents</h4><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Official Latter</label>
                                                    <input type="file" class="form-control" name="official_latter" @if(isset($employee->employeeOfficialDoc->official_latter)) value="{{$employee->employeeOfficialDoc->official_latter}}" @endif/>
                                                    <input type="hidden" class="form-control" name="official_latter_hide" @if(isset($employee->employeeOfficialDoc->official_latter)) value="{{$employee->employeeOfficialDoc->official_latter}}" @endif/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Joining Latter</label>
                                                    <input type="file" class="form-control" name="joining_latter" @if(isset($employee->employeeOfficialDoc->joining_latter)) value="{{$employee->employeeOfficialDoc->joining_latter}}" @endif/>
                                                    <input type="hidden" class="form-control" name="joining_latter_hide" @if(isset($employee->employeeOfficialDoc->joining_latter)) value="{{$employee->employeeOfficialDoc->joining_latter}}" @endif/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Contract Paper</label>
                                                    <input type="file" class="form-control" name="contract_paper" @if(isset($employee->employeeOfficialDoc->contract_paper)) value="{{$employee->employeeOfficialDoc->contract_paper}}" @endif/>
                                                    <input type="hidden" class="form-control" name="contract_paper_hide" @if(isset($employee->employeeOfficialDoc->contract_paper)) value="{{$employee->employeeOfficialDoc->contract_paper}}" @endif/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Other Documents</label>
                                                    <input type="file" class="form-control" name="other_doc_officials[]" multiple/>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Bank Information</h4><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Bank Name</label>
                                                    <input type="text" class="form-control" name="bank_name" value="{{$employee->bank_name}}"
                                                           placeholder="Bank Name"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Branch Name</label>
                                                    <input type="text" class="form-control" name="branch_name" value="{{$employee->branch_name}}"
                                                           placeholder="Branch Name"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Account Name</label>
                                                    <input type="text" class="form-control" name="account_name" value="{{$employee->account_name}}"
                                                           placeholder="Account Name"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Account Number</label>
                                                    <input type="text" class="form-control" name="account_no" value="{{$employee->account_no}}"
                                                           placeholder="Account Number"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Official Status</h4><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Department</label><span style="color:red;">*</span>
                                                    <select class="form-control" name="department_id" id="department_id" required>
                                                        <option value="{{$employee->department_id}}">@if(isset($employee->departmentName->name)){{$employee->departmentName->name}}@endif</option>
                                                        @foreach($data['department'] as $department)
                                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Designation</label><span style="color:red;">*</span>
                                                    <select class="form-control" name="designation_id" id="designation_id" required>
                                                        <option value="{{$employee->designation_id}}">@if(isset($employee->designationName->name)){{$employee->designationName->name}}@endif</option>
                                                        {{--@foreach($data['designation'] as $designation)--}}
                                                            {{--<option value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Location</label><span style="color:red;">*</span>

                                                    <select class="form-control" name="location_id" required>
                                                        <option value="{{$employee->location_id}}">@if(isset($employee->locationName->name)){{$employee->locationName->name}}@endif</option>
                                                        @foreach($data['location'] as $location)
                                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Joining Date</label>
                                                    <div class="input-append date form_datetime1"><span style="color:red;">*</span>
                                                        <input size="16" type="text" autocomplete="off" value="{{$employee->joining_date}}"
                                                               name="joining_date" placeholder="Joining Date" required
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
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
                                <td> {{$updatedSchedule->applicant->name}}</td>
                                @if(isset($updatedSchedule->status->name))
                                    <td class="center">{{$updatedSchedule->status->name}}</td>
                                @else
                                    <td class="center">No Status</td>
                                @endif
                                <td class="center">{{$updatedSchedule->applicant->designation->name}}</td>
                                <td class="center">{{$updatedSchedule->dateTime}}</td>
                                <td class="center">{{$updatedSchedule->remarks}}</td>
                                <td class="center">{{$updatedSchedule->user->first_name}} {{$updatedSchedule->user->last_name}} </td>
                                <td class="center">{{$updatedSchedule->created_at}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
    <script type="text/javascript">
        function readIMG(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#fileUploader").change(function () {
            readIMG(this);
        });
    </script>
    <script type="text/javascript">
        $('#current_country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-state-list')}}?country_id=" + countryID,
                    success: function (res) {
                        if (res) {
                            $("#current_state").empty();
                            $("#current_state").append('<option>Select</option>');
                            $.each(res, function (id, name) {
                                $("#current_state").append('<option value="' + id + '">' + name + '</option>');
                            });

                        } else {
                            $("#current_state").empty();
                        }
                    }
                });
            } else {
                $("#current_state").empty();
                $("#current_city").empty();
            }
        });
        $('#current_state').on('change', function () {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-city-list')}}?state_id=" + stateID,
                    success: function (res) {
                        if (res) {
                            $("#current_city").empty();
                            $.each(res, function (id, name) {
                                $("#current_city").append('<option value="' + id + '">' + name + '</option>');
                            });

                        } else {
                            $("#current_city").empty();
                        }
                    }
                });
            } else {
                $("#current_city").empty();
            }

        });
    </script>
    <script type="text/javascript">
        $('#permanent_country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-state-list')}}?country_id=" + countryID,
                    success: function (res) {
                        if (res) {
                            $("#permanent_state").empty();
                            $("#permanent_state").append('<option>Select</option>');
                            $.each(res, function (id, name) {
                                $("#permanent_state").append('<option value="' + id + '">' + name + '</option>');
                            });

                        } else {
                            $("#permanent_state").empty();
                        }
                    }
                });
            } else {
                $("#permanent_state").empty();
                $("#permanent_city").empty();
            }
        });
        $('#permanent_state').on('change', function () {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-city-list')}}?state_id=" + stateID,
                    success: function (res) {
                        if (res) {
                            $("#permanent_city").empty();
                            $.each(res, function (id, name) {
                                $("#permanent_city").append('<option value="' + id + '">' + name + '</option>');
                            });

                        } else {
                            $("#permanent_city").empty();
                        }
                    }
                });
            } else {
                $("#permanent_city").empty();
            }

        });
        $('#department_id').change(function () {
            var department_id = $(this).val();
            if (department_id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-designation-list')}}?department_id=" + department_id,
                    success: function (res) {
                        if (res) {
                            $("#designation_id").empty();
                            $("#designation_id").append('<option>Select</option>');
                            $.each(res, function (id, name) {
                                $("#designation_id").append('<option value="' + id + '">' + name + '</option>');
                            });

                        } else {
                            $("#designation_id").empty();
                        }
                    }
                });
            } else {
                $("#designation_id").empty();

            }
        });
    </script>
@endsection