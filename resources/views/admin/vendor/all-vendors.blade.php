@extends('admin-layout.app')
@section('title', "All Vendors")
@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Vendors Table</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{route('admin.add-vendor')}}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New Vendors
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
                                            <a href="{{route('admin.export-vendor')}}">
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

                                <select  name="professional_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Professional</option>
                                    @foreach( $data['professional'] as  $professional)
                                        <option value="{{$professional->id}}">
                                            {{$professional->name}}
                                        </option>
                                    @endforeach
                                </select>

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
                                <th> Contact No Primary</th>
                                <th> Contact No Secondary</th>
                                <th> LandLine</th>
                                <th> Address</th>
                                <th> City</th>
                                <th> Professional</th>
                                <th> Attach File</th>
                                <th> Remarks</th>
                                <th> Created By</th>
                                <th> Created At</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['allVendor'] ['allVendor'] as $vendor)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$vendor->id}} </td>
                                    <td> {{$vendor->name}}</td>
                                    <td>{{$vendor->contact_no_primary}}</td>
                                    <td class="center">{{$vendor->contact_no_secondary}}</td>
                                    <td class="center">{{$vendor->landline}}</td>
                                    <td class="center">{{$vendor->address}}</td>
                                    <td class="center">{{$vendor->city->name}}</td>
                                    <td class="center">{{$vendor->professional->name}}</td>
                                    <td class="center">
                                        <a target="_blank" href="{{route('admin.download-attach-file',$vendor->id)}}">
                                            <button class="btn btn-xs blue"><i class="fa fa-file"></i> Attach File</button>
                                        </a>
                                    </td>
                                    <td class="center">{{$vendor->remarks}}</td>
                                    <td class="center">@if(isset($vendor->user)){{$vendor->user->first_name}} {{$vendor->user->last_name}} @endif</td>
                                    <td class="center">{{$vendor->created_at}} </td>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">

                                                <li>
                                                    <a href="{{route('admin.update-vendor-view',$vendor->id)}}">
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
                                {{$data['allVendor'] ['allVendor']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection