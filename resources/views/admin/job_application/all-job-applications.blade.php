@extends('admin-layout.app')
@section('title', "All Job Applications")
@section('content')
    <link href="{{asset('assets-admin/assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}"
          rel="stylesheet" type="text/css"/>

    <style>
        thead input {
            width: 100%;
        }
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
                                                                            <span class="caption-subject font-blue-madison bold uppercase">Add Job Application Data</span>
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
                                                                                                   name="address"/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">City</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="city_name"/>
                                                                                        </div>
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

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sample_1">
                        <thead>
                        <tr>
                            <th> Id</th>
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
                                        <button class="btn btn-xs blue"><i class="fa fa-file"></i> Resume</button>
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
                                                <a href="{{route('admin.delete-job-application',$jobApplication->id)}}">
                                                    <i class="icon-trash"></i> Delete </a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#myModalApplication1_{{$jobApplication->id}}">
                                                    <i class="icon-user"></i> Edit </a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#myModalApplication2_{{$jobApplication->id}}">
                                                    <i class="icon-tag"></i> Add Schedule </a>
                                            </li>
                                        </ul>
                                        <div class="modal fade" id="myModalApplication1_{{$jobApplication->id}}"
                                             tabindex="-1"
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
                                                                                    <span class="caption-subject font-blue-madison bold uppercase">Update Job Application Data</span>
                                                                                </div>

                                                                            </div>
                                                                            <div class="portlet-body">
                                                                                <div class="tab-content">
                                                                                    <form action="{{route('admin.update-job-application',$jobApplication->id)}}"
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
                                                                                                           value="{{$jobApplication->name}}"
                                                                                                           required/>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label">Email</label>
                                                                                                    <input type="email"
                                                                                                           class="form-control"
                                                                                                           name="email"
                                                                                                           value="{{$jobApplication->email}}"
                                                                                                           required/>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label">Phone</label>
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           name="user_phone"
                                                                                                           value="{{$jobApplication->user_phone}}"
                                                                                                           required/>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label">Address</label>
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           name="address"
                                                                                                           value="{{$jobApplication->address}}"/>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label">City</label>
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           name="city_name"
                                                                                                           value="{{$jobApplication->city_name}}"/>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label">Channels</label>
                                                                                                    <select name="channel_id"
                                                                                                            class="form-control">
                                                                                                        @if($jobApplication->channel_id)
                                                                                                            <option value="{{$jobApplication->channel_id}}">{{$jobApplication->channel->name}}
                                                                                                            </option>
                                                                                                        @else
                                                                                                            <option value="">
                                                                                                                Select
                                                                                                                Channel
                                                                                                            </option>
                                                                                                        @endif
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
                                                                                                        @if($jobApplication->designation_id)
                                                                                                            <option value="{{$jobApplication->designation_id}}">{{$jobApplication->designation->name}}</option>
                                                                                                        @else
                                                                                                            <option value="">
                                                                                                                Select
                                                                                                                Designation
                                                                                                            </option>
                                                                                                        @endif
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
                                                                                                        @if($jobApplication->experience_id)
                                                                                                            <option value="{{$jobApplication->experience_id}}">{{$jobApplication->experience->name}}
                                                                                                            </option>
                                                                                                        @else
                                                                                                            <option value="">
                                                                                                                Select
                                                                                                                Experience
                                                                                                            </option>
                                                                                                        @endif
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
                                                                                                           value="{{$jobApplication->resume}}"
                                                                                                           class="form-control"
                                                                                                           name="resume"/>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="margiv-top-10">

                                                                                            <button type="submit"
                                                                                                    class="btn green">
                                                                                                Save
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                    class="btn red"
                                                                                                    data-dismiss="modal">
                                                                                                Cancel
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
                                        <div class="modal fade" id="myModalApplication2_{{$jobApplication->id}}"
                                             tabindex="-1" role="dialog" >
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-body modal-body-sub_agile">

                                                        <div class="modal_body_left modal_body_left1">


                                                            <div class="portlet light ">
                                                                <div class="portlet-title tabbable-line">
                                                                    <div class="caption caption-md">
                                                                        <i class="icon-globe theme-font hide"></i>
                                                                        <span class="caption-subject font-blue-madison bold uppercase">Add Schedule</span>
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <div class="tab-content">
                                                                        <form action="{{route('admin.update-job-application',$jobApplication->id)}}"
                                                                              method="post"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            @if($jobApplication->designation_id)
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Designation
                                                                                        :</label>
                                                                                    <input readonly
                                                                                           style="background: none; border: none"
                                                                                           value="{{$jobApplication->designation->name}}"
                                                                                    />
                                                                                </div>
                                                                            @endif
                                                                            <div class="form-group">
                                                                                <input hidden
                                                                                       name="job_id"
                                                                                       value="{{$jobApplication->id}}"
                                                                                />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="control-label">Name
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$jobApplication->name}}"
                                                                                />
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label class="control-label">Email
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$jobApplication->email}}"/>
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label class="control-label">Phone
                                                                                    :</label>
                                                                                <input readonly
                                                                                       style="background: none; border: none"
                                                                                       value="{{$jobApplication->user_phone}}"/>
                                                                            </div>

                                                                            @if($jobApplication->city_name)

                                                                                <div class="form-group">
                                                                                    <label class="control-label">Address
                                                                                        :</label>
                                                                                    <input readonly
                                                                                           style="background: none; border: none"
                                                                                           value="{{$jobApplication->address}}"/>
                                                                                </div>

                                                                            @endif

                                                                            @if($jobApplication->city_name)
                                                                                <div class="form-group">
                                                                                    <label class="control-label">City
                                                                                        :</label>
                                                                                    <input readonly
                                                                                           style="background: none; border: none"
                                                                                           value="{{$jobApplication->city_name}}"/>
                                                                                </div>
                                                                            @endif
                                                                            <div class="form-group">
                                                                                <label class="control-label">Call
                                                                                    Status</label>

                                                                                <select id="callStatus"
                                                                                        class="form-control">
                                                                                    <option value="">Select Call Status
                                                                                    </option>
                                                                                    @foreach($data['callStatus'] as  $callStatus)
                                                                                        <option value="{{$callStatus->id}}">
                                                                                            {{$callStatus->name}}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="control-label">Select Call
                                                                                    Status</label>
                                                                                <select name="callStatus_id"
                                                                                        id="callStatusSub"
                                                                                        class="form-control">
                                                                                    <option value="">Choose Call
                                                                                        Status
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="margiv-top-10">

                                                                                <button type="submit"
                                                                                        class="btn green">
                                                                                    Save
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn red"
                                                                                        data-dismiss="modal">
                                                                                    Cancel
                                                                                </button>

                                                                            </div>
                                                                        </form>
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
    <script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/scripts/datatable.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/datatables/datatables.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
            type="text/javascript"></script>


    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#sample_1 thead tr').clone(true).appendTo('#example thead');
            $('#sample_1 thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });
            var table = $('#sample_1').DataTable({
                orderCellsTop: true,
                fixedHeader: true
            });
        });

    </script>



    <script type="text/javascript">
        $('#callStatus').change(function () {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-call-status-list')}}?parent_id=" + id,
                    success: function (res) {
                        if (res) {
                            $("#callStatusSub").empty();
                            $("#callStatusSub").append('<option>Select</option>');
                            $.each(res, function (id, name) {
                                $("#callStatusSub").append('<option value="' + id + '">' + name + '</option>');
                            });
                        } else {
                            $("#callStatusSub").empty();
                        }
                    }
                });
            } else {
                $("#callStatusSub").empty();
            }
        });
    </script>
@endsection