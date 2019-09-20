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
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{route('admin.add-expense')}}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New Expense
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
                            </tr>p
                            </thead>
                            <tbody>
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
                                                <li>
                                                    <a href="{{route('admin.view-expense',$vendor->id)}}">
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
                                {{$data['allExpenses'] ['allExpenses']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection