@extends('admin-layout.app')
@section('title', "All Tawk.to Users")
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Managed Tawk.to User Table</span>
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">


                                    <a href="#" data-toggle="modal" data-target="#myModal1">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>


                                    <div class="modal fade" id="myModal1" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    <div class="scroller" style="height:500px; width: 500px;"
                                                         data-always-visible="1"
                                                         data-rail-visible1="1">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="portlet-title tabbable-line">
                                                                    <div class="caption caption-md">
                                                                        <i class="icon-globe theme-font hide"></i>
                                                                        <span class="caption-subject font-blue-madison bold uppercase">Add Tawk.to User</span>
                                                                    </div>

                                                                </div>
                                                                <hr>
                                                                <form action="{{route('admin.add-tawk-to-user')}}"
                                                                      method="post"
                                                                      enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label class="control-label">First
                                                                            Name</label>
                                                                        <input type="text"
                                                                               placeholder="First Name"
                                                                               id="first_name"
                                                                               class="form-control"
                                                                               name="first_name"
                                                                               required/></div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Last
                                                                            Name</label>
                                                                        <input type="text"
                                                                               placeholder="Last Name"
                                                                               class="form-control"
                                                                               required
                                                                               name="last_name"
                                                                               id="last_name"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Email</label>
                                                                        <input type="text"
                                                                               placeholder="Email"
                                                                               class="form-control"
                                                                               id="email"
                                                                               required
                                                                               name="email"/>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="control-label">Mobile
                                                                            Number</label>
                                                                        <input class="form-control placeholder-no-fix"
                                                                               type="text"
                                                                               placeholder="Mobile Number"
                                                                               id="user_phone"
                                                                               name="user_phone"/>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label ">Gender</label>
                                                                        <input type="radio"
                                                                               name="gender"
                                                                               id="male"
                                                                               value="Male"
                                                                               checked>
                                                                        <label for="male">Male</label>
                                                                        <span class="check"></span>

                                                                        <input type="radio"
                                                                               name="gender"
                                                                               id="female"
                                                                               value="Female">
                                                                        <label for="female">Female</label>
                                                                        <span class="check"></span>
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
                                                            <div class="col-md-6">

                                                                <div class="portlet-title tabbable-line">
                                                                    <div class="caption caption-md">
                                                                        <i class="icon-globe theme-font hide"></i>
                                                                        <span class="caption-subject font-blue-madison bold uppercase">Data Populate Tawk.to User</span>
                                                                    </div>

                                                                </div>
                                                                <hr>
                                                                <form method="post"
                                                                      enctype="multipart/form-data">
                                                                    @csrf
                                                                    <textarea id="tawktouser" rows="4"
                                                                              class="form-control"></textarea>
                                                                    <br>
                                                                    <button type="button" id="add"
                                                                            class="btn green">Populate
                                                                    </button>

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
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        {{--<li>--}}
                                        {{--<a href="javascript:;">--}}
                                        {{--<i class="fa fa-print"></i> Print </a>--}}
                                        {{--</li>--}}
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#myModal3">
                                                <i class="fa fa-file-excel-o"></i> Import an Excel </a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.export-tawk-to-user')}}">
                                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                        </li>
                                    </ul>
                                    <div class="modal fade" id="myModal3" tabindex="-1"
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
                                                                                <form action="{{route('admin.import-tawk-to-user')}}"
                                                                                      method="post"
                                                                                      enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">First
                                                                                            Name</label>
                                                                                        <input type="file"
                                                                                               class="form-control"
                                                                                               name="import_file"
                                                                                               required/></div>

                                                                                    <div class="margiv-top-10">

                                                                                        <button type="submit"
                                                                                                class="btn green">Save
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
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-toolbar">

                        <div id="sample_1_filter" class="dataTables_filter">
                            <label>Search:</label>
                            <form>
                                <input type="search" placeholder="User First name..." name="search_title"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_title'))) value="{{app('request')->input('search_title')}}" @endif>

                                <input type="search" placeholder="User Email..." name="search_email"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_email'))) value="{{app('request')->input('search_email')}}" @endif>
                                <input type="search" placeholder="User Phone..." name="search_phone"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_phone'))) value="{{app('request')->input('search_phone')}}" @endif>
                                <input type="submit" value="Search" class="btn btn-sm green">
                            </form>

                        </div>

                    </div>

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sample_1">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> Phone</th>
                            <th> Gender</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['tawk_to_users']['tawk_to_users'] as $user)
                            <tr class="odd gradeX">
                                <td class="center"> {{$user->id}} </td>
                                <td> {{$user->first_name}} {{$user->last_name}}</td>
                                <td>
                                    <a href="mailto:{{$user->email}}"> {{$user->email}}</a></td>
                                <td class="center">{{$user->user_phone}}</td>
                                <td class="center">{{$user->gender}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">
                                            <li>
                                                @if($user->is_active == 0)
                                                    <a href="{{route('admin.change-user-status',$user->id)}}">
                                                        <i class="fa fa-user-plus"></i> Active </a>
                                                @else
                                                    <a href="{{route('admin.change-user-status',$user->id)}}">
                                                        <i class="fa fa-user-times"></i> DeActive </a>
                                                @endif
                                            </li>
                                            <li>
                                                <a href="{{route('admin.delete-user',$user->id)}}">
                                                    <i class="icon-tag"></i> Delete </a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#myModal2_{{$user->id}}">
                                                    <i class="icon-user"></i> Edit </a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="myModal2_{{$user->id}}" tabindex="-1"
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
                                                                        <span class="caption-subject font-blue-madison bold uppercase">Edit Tawk.to User</span>
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <div class="tab-content">
                                                                        <form action="{{route('admin.edit-tawk-to-user',$user->id)}}"
                                                                              method="post"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="control-label">First
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                       placeholder="First Name"
                                                                                       value="{{$user->first_name}}"
                                                                                       class="form-control"
                                                                                       name="first_name"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="control-label">Last
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                       placeholder="Last Name"
                                                                                       value="{{$user->last_name}}"
                                                                                       class="form-control"
                                                                                       name="last_name"/></div>
                                                                            <div class="form-group">
                                                                                <label class="control-label">Email</label>
                                                                                <input type="text" placeholder="Email"
                                                                                       value="{{$user->email}}"
                                                                                       class="form-control"
                                                                                       name="email"/></div>


                                                                            <div class="form-group">
                                                                                <label class="control-label">Mobile
                                                                                    Number</label>
                                                                                <input class="form-control placeholder-no-fix"
                                                                                       type="text"
                                                                                       value="{{$user->user_phone}}"
                                                                                       placeholder="Mobile Number"
                                                                                       name="user_phone"/></div>

                                                                            <div class="form-group">
                                                                                <label class="control-label ">Gender</label>
                                                                                <input type="radio" name="gender"
                                                                                       id="male" value="Male" checked>
                                                                                <label for="male">Male</label>
                                                                                <span class="check"></span>

                                                                                <input type="radio" name="gender"
                                                                                       id="female" value="Female">
                                                                                <label for="female">Female</label>
                                                                                <span class="check"></span>
                                                                            </div>

                                                                            <div class="margiv-top-10">

                                                                                <button type="submit" class="btn green">
                                                                                    Save
                                                                                </button>
                                                                                <button type="button" class="btn red"
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
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">

                        <div class="col-md-7 col-sm-7">
                            <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
                                {{$data['tawk_to_users']['tawk_to_users']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#add").click(function (e) {
                e.preventDefault();
                var tawktouser = $("#tawktouser").val().split('\n');
                if (tawktouser[0]) {
                    var split_str_1 = tawktouser[0].split(':');
                    var split_str_column_1 = split_str_1[0].split(':');
                    var split_str_column_1_nameFor = split_str_column_1[0].split(' ');
                    console.log(split_str_column_1_nameFor[0]);
                    console.log(split_str_column_1_nameFor[1]);
                }
                else {
                    split_str_column_1 = null;
                }
                if (tawktouser[1]) {
                    var split_str_2 = tawktouser[1].split(':');
                    var split_str_column_2 = split_str_2[1].split(':');
                    console.log(split_str_column_2[0]);

                } else {
                    split_str_column_2 = null;
                }
                if (tawktouser[2]) {
                    var split_str_3 = tawktouser[2].split(':');
                    var split_str_column_3 = split_str_3[1].split(':');
                    console.log(split_str_column_3[0]);
                } else {
                    split_str_column_3 = null;
                }
                var first_name = split_str_column_1_nameFor[0];
                var last_name = split_str_column_1_nameFor[1];
                var email = split_str_column_2[0];
                var user_phone = split_str_column_3[0];

                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#email').val(email);
                $('#user_phone').val(user_phone);
            });
        });
    </script>
@endsection