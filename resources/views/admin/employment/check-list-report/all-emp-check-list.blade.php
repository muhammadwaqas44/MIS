@extends('admin-layout.app')
@section('title', "Employment Check List")
@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Employment Check List Table</span>
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
                                    <a href="{{route('admin.add-employee')}}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New Employee
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">&nbsp;&nbsp;&nbsp;
                                    <a href="{{route('admin.all-active-inActive-employees')}}" class="btn green  btn-outline ">
                                        All Employees

                                    </a>
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="{{route('admin.export-employees')}}">
                                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                        </li>
                                        {{--<li>--}}
                                            {{--<a href="javascript:;">--}}
                                                {{--<i class="fa fa-print"></i> Print </a>--}}
                                        {{--</li>--}}
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
                                <th> Mobile Number</th>
                                <th> Email</th>
                                <th> Designation</th>
                                <th> Status</th>
                                <th> Employment Form</th>
                                <th> CNIC copy collected</th>
                                <th> Photos collected</th>
                                <th> Educational & Experience Record - Original Seen</th>
                                <th> Educational & Experience Record - Copy Collected</th>
                                <th> Latest Original Degree Withheld</th>
                                <th> NDA Signed</th>
                                <th> Agreement Signed</th>
                                <th> Biometric registration</th>
                                <th> Office Policies Communicated</th>
                                <th> Joining Date</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['allEmploymentCheck'] ['allEmploymentCheck'] as $employee)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$employee->id}} </td>
                                    <td> {{$employee->first_name}} {{$employee->last_name}}</td>
                                    <td class="center">{{$employee->mobile_number}}</td>
                                    <td class="center">{{$employee->email}}</td>
                                    <td class="center"> @if($employee->designationName()->get()->count()>0){{$employee->designationName->name}} @endif</td>
                                    {{--                                    @if(isset($employee->applicant->history))--}}
                                    @foreach($employee->applicant->history as $histroy)
                                        <td class="center">@if(isset($histroy->status)){{$histroy->status->name}} @endif</td>
                                    @endforeach
                                    {{--@endif--}}
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_form))
                                                    @if($check->emp_form==1)
                                                        <i class="fa fa-check fa-3x"
                                                           style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                        <i class="fa fa-times fa-3x"
                                                           style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_cnic))@if($check->emp_cnic==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_photos))@if($check->emp_photos==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_educational_original))@if($check->emp_educational_original==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_educational_copy))@if($check->emp_educational_copy==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_original_deg))@if($check->emp_original_deg==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_nda))@if($check->emp_nda==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_agreement))@if($check->emp_agreement==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_biometric))@if($check->emp_biometric==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($employee->checkList->count()> 0)
                                            @foreach($employee->checkList->where('is_active', 1) as $check)
                                                @if(isset($check->emp_office_policies))@if($check->emp_office_policies==1)
                                                    <i class="fa fa-check fa-3x"
                                                       style="color: green; margin-top: 10px; margin-left: 14px"></i>  @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif @else
                                                    <i class="fa fa-times fa-3x"
                                                       style="color: red; margin-top: 10px; margin-left: 14px"></i> @endif
                                            @endforeach
                                        @else <i class="fa fa-times fa-3x"
                                                 style="color: red; margin-top: 10px; margin-left: 14px"></i>
                                        @endif
                                    </td>
                                    <td class="center">{{$employee->joining_date}}</td>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li>
                                                    <a href="{{route('admin.view-employment-check-list-page',$employee->id)}}">
                                                        <i class="icon-user"></i> View </a>
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
                                {{$data['allEmploymentCheck'] ['allEmploymentCheck']->links()}}
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