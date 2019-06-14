@extends('admin-layout.app')
@section('title', "All Job Applications")
@section('content')
    <style href="{{asset('assets-admin/assets/global/plugins/jquery-datatable/jquery.dataTables.min.css')}}"  rel="stylesheet" type="text/css" ></style>
<style>
    thead input {
        width: 100%;
    }
    table.fixedHeader-floating{position:fixed !important;background-color:white}table.fixedHeader-floating.no-footer{border-bottom-width:0}table.fixedHeader-locked{position:absolute !important;background-color:white}@media print{table.fixedHeader-floating{display:none}}
</style>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Managed Table</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="#" data-toggle="modal" data-target="#myModalApplication">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="modal fade" id="myModalApplication" tabindex="-1"
                                     role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body modal-body-sub_agile">

                                                <div class="modal_body_left modal_body_left1">


                                                    <div class="profile-content">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="portlet light ">
                                                                    <div class="portlet-title tabbable-line">
                                                                        <div class="caption caption-md">
                                                                            <i class="icon-globe theme-font hide"></i>
                                                                            <span class="caption-subject font-blue-madison bold uppercase">Import Tawk.to User</span>
                                                                        </div>

                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="tab-content">
                                                                            <form action="{{route('admin.post-job-application')}}"
                                                                                  method="post"
                                                                                  enctype="multipart/form-data">
                                                                                @csrf

                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Name</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="name"
                                                                                                   required/></div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Email</label>
                                                                                            <input type="email"
                                                                                                   class="form-control"
                                                                                                   name="email"
                                                                                                   required/></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Phone</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="user_phone"
                                                                                                   required/></div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Address</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="address"/></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">City</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="city_name"/></div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Channels</label>
                                                                                            <select name="channel_id"
                                                                                                    class="form-control">
                                                                                                <option value="">Select
                                                                                                    Channel
                                                                                                </option>
                                                                                                @foreach($data['channels'] as  $channel)
                                                                                                    <option value="{{$channel->id}}">
                                                                                                        {{$channel->name}}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Designation</label>
                                                                                            <select name="designation_id"
                                                                                                    class="form-control">
                                                                                                <option value="">Select
                                                                                                    Designation
                                                                                                </option>
                                                                                                @foreach($data['designation'] as  $designation)
                                                                                                    <option value="{{$designation->id}}">
                                                                                                        {{$designation->name}}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Experience</label>
                                                                                            <select name="experience_id"
                                                                                                    class="form-control">
                                                                                                <option value="">Select
                                                                                                    Experience
                                                                                                </option>
                                                                                                @foreach($data['experience'] as  $experience)
                                                                                                    <option value="{{$experience->id}}">
                                                                                                        {{$experience->name}}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Resume</label>
                                                                                            <input type="file"
                                                                                                   class="form-control"
                                                                                                   name="resume"
                                                                                                   required/>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="margiv-top-10">

                                                                                    <button type="submit"
                                                                                            class="btn green">Save
                                                                                    </button>
                                                                                    <button type="button"
                                                                                            class="btn red"
                                                                                            data-dismiss="modal">Cancel
                                                                                    </button>

                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- //Modal content-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
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
                    {{--<div class="table-toolbar">--}}
                        {{--<div id="sample_1_filter" class="dataTables_filter">--}}
                            {{--<label>Search:</label>--}}
                            {{--<form>--}}
                                {{--<input type="search" placeholder="User First name..." name="search_title"--}}
                                       {{--class="form-control input-sm input-small input-inline"--}}
                                       {{--@if(!empty(app('request')->input('search_title'))) value="{{app('request')->input('search_title')}}" @endif>--}}
                                {{--<input type="search" placeholder="User Email..." name="search_email"--}}
                                       {{--class="form-control input-sm input-small input-inline"--}}
                                       {{--@if(!empty(app('request')->input('search_email'))) value="{{app('request')->input('search_email')}}" @endif>--}}
                                {{--<input type="search" placeholder="User Phone..." name="search_phone"--}}
                                       {{--class="form-control input-sm input-small input-inline"--}}
                                       {{--@if(!empty(app('request')->input('search_phone'))) value="{{app('request')->input('search_phone')}}" @endif>--}}
                                {{--<select id="role" name="role_id" class="form-control input-sm input-small input-inline">--}}
                                    {{--<option value="">Select Role</option>--}}
                                    {{--@foreach($data['roles'] as  $role)--}}
                                        {{--<option value="{{$role->id}}">--}}
                                            {{--{{$role->name}}--}}
                                        {{--</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                                {{--<input type="submit" value="Search" class="btn btn-sm green">--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <table class="table table-striped table-bordered table-hover " id="example" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> Phone</th>
                            <th> Resume</th>
                            <th> Joined</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['allJobApplications'] ['allJobApplications'] as $jobApplication)
                            <tr class="odd gradeX">
                                <td class="center"> {{$jobApplication->id}} </td>
                                <td> {{$jobApplication->name}}</td>
                                <td>
                                    <a href="mailto:{{$jobApplication->email}}"> {{$jobApplication->email}}</a>
                                </td>

                                <td class="center">{{$jobApplication->user_phone}}</td>
                                <td class="center">
                                    <a href="{{route('admin.download-resume',$jobApplication->id)}}">
                                        <i class="fa fa-file"></i> Resume
                                    </a>
                                </td>

                                <td class="center">{{$jobApplication->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">
                                            <li>
                                                @if($jobApplication->is_active == 0)
                                                    <a href="{{route('admin.change-user-status',$jobApplication->id)}}">
                                                        <i class="fa fa-user-plus"></i> Active </a>
                                                @else
                                                    <a href="{{route('admin.change-user-status',$jobApplication->id)}}">
                                                        <i class="fa fa-user-times"></i> DeActive </a>
                                                @endif
                                            </li>
                                            <li>
                                                <a href="{{route('admin.delete-job-application',$jobApplication->id)}}">
                                                    <i class="icon-tag"></i> Delete </a>
                                            </li>
                                            <li>
                                                <a href="{{route('admin.update-account',$jobApplication->id)}}">
                                                    <i class="icon-user"></i> Edit </a>
                                            </li>
                                            <li class="divider"></li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">

                        <div class="col-md-7 col-sm-7">
                            <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
                                                                {{$data['allJobApplications'] ['allJobApplications']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <script src="{{asset('assets-admin/assets/global/plugins/jquery-datatable/jquery-3.3.1.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/jquery-datatable/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/jquery-datatable/dataTables.fixedHeader.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example thead tr').clone(true).appendTo( '#example thead' );
        $('#example thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        var table = $('#example').DataTable( {
            orderCellsTop: true,
            fixedHeader: true
        } );
    } );

    $(document).ready(function() {
        $('#example').DataTable( {
            initComplete: function () {
                this.columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );
    } );
</script>
@endsection