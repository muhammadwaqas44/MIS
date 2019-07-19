@extends('admin-layout.app')
@section('title', "All Employees")
@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> All Employees Table</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{route('admin.add-employee')}}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">&nbsp;&nbsp;&nbsp;
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
                                <input type="search" placeholder="Search..." name="search_title"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_title'))) value="{{app('request')->input('search_title')}}" @endif>

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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="sample_1">
                            <thead>
                            <tr>
                                <th> Id</th>
                                <th> Name</th>
                                <th> Data Of Birth</th>
                                <th> Gender</th>
                                <th> Marital Status</th>
                                <th> Father's Name</th>
                                <th> Nationality</th>
                                <th> Nationality Identity Type</th>
                                <th> Nationality Identity No</th>
                                <th> Current Address</th>
                                <th> Current Country</th>
                                <th> Current State</th>
                                <th> Current City</th>
                                <th> Permanent Address</th>
                                <th> Permanent Country</th>
                                <th> Permanent State</th>
                                <th> Permanent City</th>
                                <th> Mobile Number</th>
                                <th> Secondary Number</th>
                                <th> Skype ID</th>
                                <th> Email</th>
                                <th> Resume</th>
                                <th> ID Proof</th>
                                <th> Other Personal Document</th>
                                <th> Official Latter</th>
                                <th> Joining Latter</th>
                                <th> Contract Paper</th>
                                <th> Other Personal Document</th>
                                <th> Bank Name</th>
                                <th> Branch Name</th>
                                <th> Account Name</th>
                                <th> Account Number</th>
                                <th> Department</th>
                                <th> Designation</th>
                                <th> Location</th>
                                <th> Joining Date</th>
                                <th> Created At</th>
                                <th> Created By</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['allEmployees'] ['allEmployees'] as $employee)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$employee->id}} </td>
                                    <td> {{$employee->first_name}} {{$employee->last_name}}</td>
                                    <td>{{$employee->date_of_birth}}</td>
                                    <td class="center">{{$employee->gender}}</td>
                                    <td class="center">{{$employee->marital_status}}</td>
                                    <td class="center">{{$employee->father_name}}</td>
                                    <td class="center">{{$employee->nationalityCountry->name}}</td>
                                    <td class="center">{{$employee->n_identity_type}}</td>
                                    <td class="center">{{$employee->n_identity_no}}</td>
                                    <td class="center">{{$employee->current_address}}</td>
                                    <td class="center">{{$employee->currentCountry->name}}</td>
                                    <td class="center">{{$employee->currentState->name}}</td>
                                    <td class="center">{{$employee->currentCity->name}}</td>
                                    <td class="center">{{$employee->permanent_address}}</td>
                                    <td class="center">{{$employee->permanentCountry->name}}</td>
                                    <td class="center">{{$employee->permanentState->name}}</td>
                                    <td class="center">{{$employee->permanentCity->name}}</td>
                                    <td class="center">{{$employee->mobile_number}}</td>
                                    <td class="center">{{$employee->secondary_number}}</td>
                                    <td class="center">{{$employee->skype_id}}</td>
                                    <td class="center">{{$employee->email}}</td>
                                    <td class="center">
                                        <a href="{{route('admin.download-resume-employee',$employee->id)}}"
                                           target="_blank">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Resume</button>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="{{route('admin.download-id-proof-employee',$employee->id)}}"
                                           target="_blank">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> ID Proof</button>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="{{route('admin.download-other-doc-personal-employee',$employee->id)}}"
                                           target="_blank">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Other Personal
                                                Document
                                            </button>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="{{route('admin.download-official-latter-employee',$employee->id)}}"
                                           target="_blank">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Official Latter
                                            </button>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="{{route('admin.download-joining-latter-employee',$employee->id)}}"
                                           target="_blank">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Joining Latter
                                            </button>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="{{route('admin.download-contract-paper-employee',$employee->id)}}"
                                           target="_blank">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Contract Paper
                                            </button>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="{{route('admin.download-other-doc-official-employee',$employee->id)}}"
                                           target="_blank">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Other Official
                                                Document
                                            </button>
                                        </a>
                                    </td>
                                    <td class="center">{{$employee->bank_name}}</td>
                                    <td class="center">{{$employee->branch_name}}</td>
                                    <td class="center">{{$employee->account_name}}</td>
                                    <td class="center">{{$employee->account_no}}</td>
                                    <td class="center">{{$employee->departmentName->name}}</td>
                                    <td class="center">{{$employee->designationName->name}}</td>
                                    <td class="center">{{$employee->locationName->name}}</td>
                                    <td class="center">{{$employee->joining_date}}</td>
                                    <td class="center">{{$employee->created_at}}</td>
                                    <td class="center">
                                        @if($employee->user()->get()->count()>0){{$employee->user->first_name}}{{$employee->user->last_name}}
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">

                                                <li>
                                                    <a href="{{route('admin.update-employee-view',$employee->id)}}">
                                                        <i class="icon-user"></i> View </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#myModalApplication2_{{$employee->id}}">
                                                        <i class="icon-tag"></i> Add </a>
                                                </li>
                                            </ul>
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
                                {{$data['allEmployees'] ['allEmployees']->links()}}
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
    </script>

@endsection