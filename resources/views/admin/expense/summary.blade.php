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
                        <span class="caption-subject bold uppercase"> Expenses Summary</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-3">
                                {{--<div class="btn-group">--}}
                                {{--<a href="{{route('admin.add-expense')}}">--}}
                                {{--<button id="sample_editable_1_new" class="btn sbold green"> Add New Expense--}}
                                {{--<i class="fa fa-plus"></i>--}}
                                {{--</button>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                            </div>
                            <div class="col-md-6">
                                {{--<div>--}}
                                {{--<h4>Total Amount of {{auth()->user()->first_name}} {{auth()->user()->last_name}} =--}}
                                {{--<strong>{{$amount}} </strong></h4>--}}
                                {{--</div>--}}
                            </div>
                            <div class="col-md-3">
                                <div class="btn-group pull-right">&nbsp;&nbsp;&nbsp;
                                    {{--<a href="{{route('admin.send-mail')}}">--}}
                                    {{--<button class="btn green">--}}
                                    {{--Send--}}
                                    {{--</button>--}}
                                    {{--</a>--}}
                                    {{--<button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools--}}
                                    {{--<i class="fa fa-angle-down"></i>--}}
                                    {{--</button>--}}
                                    {{--<ul class="dropdown-menu pull-right">--}}
                                    {{--<li>--}}
                                    {{--<a href="{{route('admin.export-expenses')}}">--}}
                                    {{--<i class="fa fa-file-excel-o"></i> Export to Excel </a>--}}
                                    {{--</li>--}}
                                    {{--</ul>--}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-toolbar">

                        <div id="sample_1_filter" class="dataTables_filter">
                            <label>Search:</label>
                            <form>

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
                                                <input type="text" name="date1" autocomplete="off"
                                                       class="form-control input-sm input-small input-inline"
                                                       placeholder="Form Date ..">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                            </span>
                                <span class="input-append date form_datetime1">
                                                <input size="16" type="text" name="date2" autocomplete="off"
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
                               style="border: 2px solid black"
                               id="sample_1">
                            <thead>
                            <tr>

                                <th> Type</th>
                                <th> Category</th>
                                <th> Amount</th>
                                <th> Records</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th rowspan="{{$data['funds']['funds']->count()+1}} ">Funds</th>

                            </tr>
                            @foreach($data['funds']['funds'] as $vendor)
                                <tr class="odd gradeX">
                                    <td>
                                        {{$vendor->categoryName->name}}
                                    </td>
                                    <td> {{$vendor->sum}}</td>
                                    <td> {{$vendor->count}}</td>

                                </tr>

                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Total
                                </th>
                                <th>
                                    {{$data['funds']['funds']->sum('sum')}}
                                </th>
                                <th>
                                    {{$data['funds']['funds']->sum('count')}}
                                </th>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               style="border: 2px solid black"
                               id="sample_1">
                            <thead>
                            <tr>

                                <th> Type</th>
                                <th> Category</th>
                                <th> Amount</th>
                                <th> Records</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th rowspan="{{$data['expenses']['expenses']->count()+1}} ">Expenses</th>

                            </tr>
                            @foreach($data['expenses']['expenses'] as $vendor)
                                <tr class="odd gradeX">
                                    <td>
                                        {{$vendor->categoryName->name}}
                                    </td>
                                    <td> {{$vendor->sum}}</td>
                                    <td> {{$vendor->count}}</td>

                                </tr>

                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Total
                                </th>
                                <th>
                                    {{$data['expenses']['expenses']->sum('sum')}}
                                </th>
                                <th>
                                    {{$data['expenses']['expenses']->sum('count')}}
                                </th>
                            </tr>
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