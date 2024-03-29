@extends('admin-layout.app')
@section('title', "Ideas")
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Content Management Tool
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Ideas
            </li>
        </ul>
    </div>
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Ideas Table </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{route('admin.add-idea')}}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New Idea
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
                                        {{--<li>--}}
                                        {{--<a href="{{route('admin.export-vendor')}}">--}}
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
                                <select name="category_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Category</option>
                                    @foreach( $data['category'] as  $professional)
                                        <option value="{{$professional->id}}">
                                            {{$professional->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="status_id"
                                        class="form-control input-sm input-small input-inline">
                                    <option value="">Select Status</option>
                                    @foreach( $data['statuses'] as  $professional)
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
                                <th> Topic</th>
                                <th> Status</th>
                                <th> Category</th>
                                <th> Reference Meterial</th>
                                <th> Remarks</th>
                                <th> Created By</th>
                                <th> Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $data['allIdeas']['allIdeas'] as $plan)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$plan->content->id}} </td>
                                    <td><a href="{{route('admin.edit-idea',$plan->content->id)}}" style="color: black">
                                            {{$plan->content->topic}}</a></td>
                                    <td class="center">
                                        {{$plan->c_status->name}}</td>
                                    <td>@if(isset($plan->content->category)){{$plan->content->category->name}}@endif</td>
                                    <td class="center"title="{{$plan->content->reference_material}}">{{ str_limit($plan->content->reference_material, $limit = 60, $end = '...') }}</td>

                                    <td class="center" title="{{$plan->remarks}}">{{ str_limit($plan->remarks, $limit = 60, $end = '...') }}
                                         </td>
                                    <td class="center">{{$plan->content->user->first_name}} {{$plan->content->user->last_name}}  </td>
                                    <td class="center">{{$plan->content->created_at}} </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">

                        <div class="col-md-7 col-sm-7">
                            <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
                                {{$data['allIdeas']['allIdeas']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection