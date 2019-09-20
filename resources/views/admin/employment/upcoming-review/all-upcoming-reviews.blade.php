@extends('admin-layout.app')
@section('title', "All Upcoming Reviews")
@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Upcoming Review Table</span>
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
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <a href="{{route('admin.all-active-inActive-employees')}}"
                                       class="btn green  btn-outline ">
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
                                <th> Status</th>
                                <th> Review Due On</th>
                                <th> Remarks</th>
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
                                    @foreach($employee->applicant->history as $histroy)
                                        <td class="center">@if(isset($histroy->status)){{$histroy->status->name}} @endif</td>
                                    @endforeach
                                    <td>{{$employee->probation_due_on}}</td>
                                    <td>{{$employee->remarks}}</td>
                                    <td>{{$employee->date_of_birth}}</td>
                                    <td class="center">{{$employee->gender}}</td>
                                    <td class="center">{{$employee->marital_status}}</td>
                                    <td class="center">{{$employee->father_name}}</td>
                                    <td class="center">@if(isset($employee->nationalityCountry->name)){{$employee->nationalityCountry->name}}@endif</td>
                                    <td class="center">{{$employee->n_identity_type}}</td>
                                    <td class="center">{{$employee->n_identity_no}}</td>
                                    <td class="center">{{$employee->current_address}}</td>
                                    <td class="center">@if(isset($employee->currentCountry->name)){{$employee->currentCountry->name}}@endif</td>
                                    <td class="center">@if(isset($employee->currentState->name)){{$employee->currentState->name}}@endif</td>
                                    <td class="center">@if(isset($employee->currentCity->name)){{$employee->currentCity->name}}@endif</td>
                                    <td class="center">{{$employee->permanent_address}}</td>
                                    <td class="center">@if(isset($employee->permanentCountry->name)){{$employee->permanentCountry->name}}@endif</td>
                                    <td class="center">@if(isset($employee->permanentState->name)){{$employee->permanentState->name}}@endif</td>
                                    <td class="center">@if(isset($employee->permanentCity->name)){{$employee->permanentCity->name}}@endif</td>
                                    <td class="center">{{$employee->mobile_number}}</td>
                                    <td class="center">{{$employee->secondary_number}}</td>
                                    <td class="center">{{$employee->skype_id}}</td>
                                    <td class="center">{{$employee->email}}</td>
                                    <td class="center">
                                        @if($employee->employeePersonalDocument)
                                            @foreach($employee->employeePersonalDocument()->where('type','=','resume')->get() as $item)
                                                <a href="{{route('admin.download-resume-employee',$item->id)}}"
                                                   target="_blank">
                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Resume
                                                    </button>
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if(isset($employee->employeePersonalDocument))
                                            @foreach($employee->employeePersonalDocument()->where('type','=','id_proof')->get() as $item)
                                                <a href="{{route('admin.download-id-proof-employee',$item->id)}}"
                                                   target="_blank">
                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Id Proof
                                                    </button>
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if(isset($employee->employeePersonalDocument))
                                            @foreach($employee->employeePersonalDocument()->where('type','=','other_doc_personal')->get() as $item)
                                                <a href="{{route('admin.download-other-doc-personal-employee',$item->id)}}"
                                                   target="_blank">
                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Other Doc
                                                        Personal
                                                    </button>
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if(isset($employee->employeeOfficialDocument))
                                            @foreach($employee->employeeOfficialDocument()->where('type','=','official_latter')->get() as $item)
                                                <a href="{{route('admin.download-official-latter-employee',$item->id)}}"
                                                   target="_blank">
                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Official
                                                        Latter
                                                    </button>
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if(isset($employee->employeeOfficialDocument))
                                            @foreach($employee->employeeOfficialDocument()->where('type','=','joining_latter')->get() as $item)
                                                <a href="{{route('admin.download-joining-latter-employee',$item->id)}}"
                                                   target="_blank">
                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Official
                                                        Latter
                                                    </button>
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if(isset($employee->employeeOfficialDocument))
                                            @foreach($employee->employeeOfficialDocument()->where('type','=','contract_paper')->get() as $item)
                                                <a href="{{route('admin.download-contract-paper-employee',$item->id)}}"
                                                   target="_blank">
                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Official
                                                        Latter
                                                    </button>
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if(isset($employee->employeeOfficialDocument))
                                            @foreach($employee->employeeOfficialDocument()->where('type','=','other_doc_official')->get() as $item)
                                                <a href="{{route('admin.download-other-doc-official-employee',$item->id)}}"
                                                   target="_blank">
                                                    <button class="btn btn-xs blue"><i class="fa fa-file"></i> Official
                                                        Latter
                                                    </button>
                                                </a>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td class="center">{{$employee->bank_name}}</td>
                                    <td class="center">{{$employee->branch_name}}</td>
                                    <td class="center">{{$employee->account_name}}</td>
                                    <td class="center">{{$employee->account_no}}</td>
                                    <td class="center">@if($employee->departmentName()->get()->count()>0){{$employee->departmentName->name}}@endif</td>
                                    <td class="center"> @if($employee->designationName()->get()->count()>0){{$employee->designationName->name}} @endif</td>
                                    <td class="center"> @if($employee->locationName()->get()->count()>0){{$employee->locationName->name}}@endif</td>
                                    <td class="center">{{$employee->joining_date}}</td>
                                    <td class="center">{{$employee->created_at}}</td>
                                    <td class="center">
                                        @if($employee->user()->get()->count()>0){{$employee->user->first_name}} {{$employee->user->last_name}}
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
                                                    <a href="{{route('admin.status-employee-review',$employee->id)}}">
                                                        <i class="icon-tag"></i> Review OutCOme </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('admin.next-review-employee',$employee->id)}}">
                                                        <i class="icon-tag"></i> Next Review </a>
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