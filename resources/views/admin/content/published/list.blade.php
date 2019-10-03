@extends('admin-layout.app')
@section('title', "CMT-Published")
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                CMT
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Published
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
                        <span class="caption-subject bold uppercase"> Published Table </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    {{--<a href="{{route('admin.create-content')}}">--}}
                                    {{--<button id="sample_editable_1_new" class="btn sbold green"> Add New content--}}
                                    {{--<i class="fa fa-plus"></i>--}}
                                    {{--</button>--}}
                                    {{--</a>--}}
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
                                <th> Production Schedule</th>
                                <th> Production Assign To</th>
                                <th> Processing Schedule</th>
                                <th> Processing Assign To</th>
                                <th> Publishing Schedule</th>
                                <th> Publishing Assign To</th>
                                {{--<th> PlatForms</th>--}}
                                <th> Remarks</th>
                                <th> Created By</th>
                                <th> Created At</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $data['allPublished']['allPublished'] as $plan)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$plan->content->id}} </td>
                                    <td>
                                        <a href="{{route('admin.all-published-view',$plan->content->id)}}"
                                           style="color: black">
                                            {{$plan->content->topic}}</a>
                                    </td>
                                    <td> {{$plan->c_status->name}}</td>
                                    <td>@if(isset($plan->content->category)){{$plan->content->category->name}} @endif</td>
                                    <td class="center">{{$plan->content->produce_on}}</td>
                                    <td class="center">@if(isset($plan->content->produceBy)){{$plan->content->produceBy->first_name}} {{$plan->content->produceBy->last_name}} @endif</td>
                                    <td class="center">{{$plan->content->process_on}}</td>
                                    <td class="center">@if(isset($plan->content->processBy)){{$plan->content->processBy->first_name}} {{$plan->content->processBy->last_name}} @endif</td>
                                    <td class="center">{{$plan->content->publish_on}}</td>
                                    <td class="center">@if(isset($plan->content->publishBy)){{$plan->content->publishBy->first_name}} {{$plan->content->publishBy->last_name}} @endif</td>
                                    {{--<td class="center">--}}
                                        {{--@foreach($plan->content->c_platformsUsed->take(2) as $item){{$item->c_platforms->name}}--}}
                                        {{--<br>@endforeach ....--}}
                                    {{--</td>--}}
                                    <td class="center" title="{{$plan->remarks}}">{{ str_limit($plan->remarks, $limit = 60, $end = '...') }}</td>
                                    <td class="center">{{$plan->createdByName->first_name}} {{$plan->createdByName->last_name}}  </td>
                                    <td class="center">{{$plan->created_at}} </td>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">

                                                <li>
                                                    <a href="{{route('admin.all-published-view',$plan->content->id)}}">
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
                                {{$data['allPublished']['allPublished']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection