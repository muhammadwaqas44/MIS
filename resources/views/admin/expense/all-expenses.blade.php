@extends('admin-layout.app')
@section('title', "All Expenses")
@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Expenses Table</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="btn-group">
                                    <a href="{{route('admin.add-expense')}}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New Expense
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <h4>Total Balance of {{auth()->user()->first_name}} {{auth()->user()->last_name}} =
                                        <strong>{{$amount}} </strong></h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="btn-group pull-right">&nbsp;&nbsp;&nbsp;
                                    <a href="{{route('admin.search-expenses')}}" class="btn btn-info">
                                        Summary
                                    </a>
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="{{route('admin.export-expenses')}}">
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

                                <select name="type_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Type</option>
                                    @foreach( $data['type'] as  $professional)
                                        <option value="{{$professional->id}}">
                                            {{$professional->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="cat_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Category</option>
                                    @foreach( $data['category'] as  $professional)
                                        <option value="{{$professional->id}}">
                                            {{$professional->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="emp_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Employee</option>
                                    @foreach( $data['employees'] as  $professional)
                                        <option value="{{$professional->id}}">
                                            {{$professional->first_name}} {{$professional->last_name}}
                                        </option>
                                    @endforeach
                                </select>

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
                    <div class="">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="sample_1">
                            <thead>
                            <tr>
                                <th> Id</th>
                                <th> Amount</th>
                                <th> Date</th>
                                <th> Expense Type</th>
                                <th> Category</th>
                                <th> Description</th>
                                <th> Employee Name</th>
                                <th> Created By</th>
                                <th> Created At</th>
                                <th> File</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--<tr>--}}
                            {{--                                <form  method="get" action="{{route('admin.search-expenses')}}">--}}
                            {{--<td></td>--}}
                            {{--<td> Amount</td>--}}
                            {{--<td>--}}
                            {{--<a href="{{route('admin.search-expenses')}}" class="btn btn-info"--}}
                            {{--style="width: 100%; text-align: center">--}}
                            {{--Date--}}
                            {{--</a>--}}
                            {{--<span class="input-append date form_datetime1">--}}
                            {{--<input type="text" name="date1" autocomplete="off"--}}
                            {{--class="form-control input-sm input-small input-inline"--}}
                            {{--placeholder="Date">--}}
                            {{--<span class="add-on"><i class="icon-th"></i></span>--}}
                            {{--</span>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                            {{--<button class="btn  btn-outline dropdown-toggle" data-toggle="dropdown">Category--}}
                            {{--<i class="fa fa-angle-down"></i>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--@foreach( $data['type'] as  $professional)--}}
                            {{--<li>--}}
                            {{--<a href="{{route('admin.exp-type')}}">--}}
                            {{--<option value="{{$professional->id}}">--}}
                            {{--{{$professional->name}}--}}
                            {{--</option>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--@endforeach--}}
                            {{--</ul>--}}
                            {{--<select name="type_id"--}}
                            {{--class="form-control input-sm input-small input-inline">--}}
                            {{--<option value="">Select Type</option>--}}
                            {{--@foreach( $data['type'] as  $professional)--}}
                            {{--<a href="{{route('admin.exp-type')}}">--}}
                            {{--<option value="{{$professional->id}}">--}}
                            {{--{{$professional->name}}--}}
                            {{--</option>--}}
                            {{--</a>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                            {{--<button class="btn  btn-outline dropdown-toggle" data-toggle="dropdown">Category--}}
                            {{--<i class="fa fa-angle-down"></i>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--@foreach( $data['category'] as  $professional)--}}
                            {{--<li>--}}
                            {{--<a href="{{route('admin.exp-cat',$professional->id)}}">--}}
                            {{--<option value="{{$professional->id}}">--}}
                            {{--{{$professional->name}}--}}
                            {{--</option>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--@endforeach--}}
                            {{--</ul>--}}
                            {{--<select name="cat_id"--}}
                            {{--class="form-control input-sm input-small input-inline">--}}
                            {{--<option value="">Select Category</option>--}}
                            {{--@foreach( $data['category'] as  $professional)--}}

                            {{--<option value="{{$professional->id}}">--}}
                            {{--<a href="{{route('admin.exp-cat',$professional->id)}}">--}}
                            {{--{{$professional->name}}--}}
                            {{--</a>--}}
                            {{--</option>--}}

                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--</td>--}}
                            {{--<td> Description</td>--}}
                            {{--<td>--}}
                            {{--<button class="btn  btn-outline dropdown-toggle" data-toggle="dropdown">Category--}}
                            {{--<i class="fa fa-angle-down"></i>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--@foreach( $data['employees'] as  $professional)--}}
                            {{--<li>--}}
                            {{--<a href="{{route('admin.exp-emp')}}">--}}
                            {{--<option value="{{$professional->id}}">--}}
                            {{--{{$professional->name}}--}}
                            {{--</option>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--@endforeach--}}
                            {{--</ul>--}}
                            {{--<select name="emp_id"--}}
                            {{--class="form-control input-sm input-small input-inline">--}}
                            {{--<option value="">Select Employee</option>--}}
                            {{--@foreach( $data['employees'] as  $professional)--}}
                            {{--<a href="{{route('admin.exp-emp')}}">--}}
                            {{--<option value="{{$professional->id}}">--}}
                            {{--{{$professional->first_name}} {{$professional->last_name}}--}}
                            {{--</option>--}}
                            {{--</a>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}

                            {{--</td>--}}
                            {{--<td> Created By</td>--}}
                            {{--<td>--}}
                            {{--                                        <a href="{{route('admin.search-expenses')}}" class="btn btn-info" style="width: 100%; text-align: center">--}}
                            {{--Created At--}}
                            {{--</a>--}}
                            {{--<span class="input-append date form_datetime1">--}}
                            {{--<input type="text" name="created" autocomplete="off"--}}
                            {{--class="form-control input-sm input-small input-inline"--}}
                            {{--placeholder="Created At">--}}
                            {{--<span class="add-on"><i class="icon-th"></i></span>--}}
                            {{--</span>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                            {{--<input type="submit" value="Search" class="btn btn-sm green">--}}
                            {{--File--}}
                            {{--</td>--}}
                            {{--<td>--}}
                            {{--Action--}}
                            {{--</td>--}}
                            {{--</form>--}}
                            {{--</tr>--}}
                            @foreach($data['allExpenses'] ['allExpenses'] as $vendor)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$vendor->id}} </td>
                                    <td> {{$vendor->amount}}</td>
                                    <td> {{$vendor->date}}</td>
                                    <td>{{$vendor->typeName->name}}</td>
                                    <td>{{$vendor->categoryName->name}}</td>
                                    <td class="center">{{$vendor->description}}</td>
                                    <td class="center">@if(isset($vendor->empName)){{$vendor->empName->first_name}} {{$vendor->empName->last_name}} @endif</td>
                                    <td class="center">@if(isset($vendor->createdBy)){{$vendor->createdBy->first_name}} {{$vendor->createdBy->last_name}} @endif</td>
                                    <td class="center">{{$vendor->created_at}} </td>
                                    <td class="center">
                                        <a target="_blank" href="{{route('admin.download-exp-file',$vendor->id)}}">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> File</button>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">

                                                @if( auth()->user()->role_id == 1 || $vendor->created_at->format("Y-m-d") == Carbon\Carbon::today()->format("Y-m-d"))
                                                    <li>
                                                        <a href="{{route('admin.view-expense',$vendor->id)}}">
                                                            <i class="icon-user"></i> View </a>
                                                    </li>
                                                @endif
                                                @if( auth()->user()->role_id == 1)
                                                    <li>
                                                        <a href="{{route('admin.delete-expense',$vendor->id)}}">
                                                            <i class="icon-user"></i> Delete </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2">Total Amount</td>
                                <td colspan="9">{{$data['allExpenses']['amount']}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
                                {{$data['allExpenses'] ['allExpenses']->links()}}
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