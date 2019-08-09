@extends('admin-layout.app')
@section('title', "All Winners")
@section('content')


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Winners Table</span>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="#" data-toggle="modal" data-target="#myModalForWinner">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                    <div class="modal fade bs-modal-lg" id="myModalForWinner" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">

                                                    <div class="portlet-title tabbable-line">
                                                        <div class="caption caption-md">
                                                            <i class="icon-globe theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Add Winner Data</span>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">

                                                        <form action="{{route('admin.add-data-winner')}}"
                                                              method="post"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-6">


                                                                <div class="form-group">
                                                                    <label class="control-label">First
                                                                        Name</label><span style="color:red;">*</span>
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
                                                                           name="last_name"
                                                                           id="last_name"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text"
                                                                           placeholder="Email"
                                                                           class="form-control"
                                                                           id="email"
                                                                           name="email"/>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">Prize</label><span
                                                                                style="color:red;">*</span>
                                                                        <select class="form-control placeholder-no-fix"
                                                                                required
                                                                                name="prize">
                                                                            <option value="">Select Prize</option>
                                                                            @foreach($data['prizes'] as $prize)
                                                                                <option value="{{$prize->id}}">{{$prize->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">Winning
                                                                            Date</label><span
                                                                                style="color:red;">*</span>

                                                                        <span class="input-append date form_datetime1">
                                                <input size="16" type="text" name="winning_date" autocomplete="off"
                                                       class="form-control" required
                                                       placeholder="Winning Date">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                            </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">CNIC
                                                                            Number</label>
                                                                        <input class="form-control placeholder-no-fix"
                                                                               type="text"
                                                                               placeholder="CNIC Number"
                                                                               name="cnic"/>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">Account
                                                                            Number</label>
                                                                        <input class="form-control placeholder-no-fix"
                                                                               type="text"
                                                                               placeholder="Acount Number"
                                                                               name="account"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row " style="margin-top: 12px" >
                                                                    <div class="col-md-6">
                                                                            <label class="control-label">Mobile
                                                                                Number</label>
                                                                            <input class="form-control placeholder-no-fix"
                                                                                   type="text"
                                                                                   placeholder="Mobile Number"
                                                                                   id="user_phone"
                                                                                   name="user_phone"/>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                            <label class="control-label">Social
                                                                                Links</label>
                                                                            <input class="form-control placeholder-no-fix"
                                                                                   type="text"
                                                                                   placeholder="Social Links"
                                                                                   name="social_link"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Address</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text"
                                                                           placeholder="Address"
                                                                           name="address"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Remarks</label>
                                                                    <textarea class="form-control" rows="3"
                                                                              name="question">
                                                                        </textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
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
                                                            </div>

                                                        </form>
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
                                        <li>
                                            {{--<a href="#" data-toggle="modal" data-target="#myModal3">--}}
                                                {{--<i class="fa fa-file-excel-o"></i> Import an Excel--}}
                                            {{--</a>--}}
                                        </li>
                                        <li>
                                            <a href="{{route('admin.export-winner')}}">
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
                                <input type="search" placeholder="Name,Email,Phone,Address" name="search_title"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_title'))) value="{{app('request')->input('search_title')}}" @endif>

                                <input type="search" placeholder="Status..." name="search_email"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_email'))) value="{{app('request')->input('search_email')}}" @endif>

                                <input type="submit" value="Search" class="btn btn-sm green">
                            </form>

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
                            <th> Status</th>
                            <th> Address</th>
                            <th> Winning Date</th>
                            <th> Social Link</th>
                            <th> Prize</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['winners']['winners'] as $winner)

                            <tr class="odd gradeX">
                                <td class="center"> {{$winner->id}} </td>
                                <td> {{$winner->first_name}} {{$winner->last_name}}</td>
                                <td class="center">@if(isset($winner->user->email)){{$winner->user->email}}@endif</td>
                                <td class="center">{{$winner->user_phone}}</td>
                                <td class="center">@if(isset($winner->statusName->name)){{$winner->statusName->name}}@endif</td>
                                <td class="center">{{$winner->address}}</td>
                                <td class="center">@if(isset($winner->winning_date)){{$winner->winning_date}}@endif</td>
                                <td class="center"><a href="{{$winner->social_link}} " style="color: black"><i
                                                class="fa fa-internet-explorer"></i> Social Media Link</a></td>
                                <td class="center">@if(isset($winner->prizeName->name)){{$winner->prizeName->name}}@endif</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#editWinner_{{$winner->id}}">
                                                    {{--<a href="{{route('admin.update-account',$winner->id)}}">--}}
                                                    <i class="icon-user"></i> View </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal fade bs-modal-lg" id="editWinner_{{$winner->id}}" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">

                                                    <div class="portlet-title tabbable-line">
                                                        <div class="caption caption-md">
                                                            <i class="icon-globe theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Edit Winner Data</span>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">

                                                        <form action="{{route('admin.edit-data-winner',$winner->id)}}"
                                                              method="post"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">First
                                                                        Name</label><span style="color:red;">*</span>
                                                                    <input type="text"
                                                                           placeholder="First Name"
                                                                           id="first_name"
                                                                           class="form-control"
                                                                           name="first_name"
                                                                           value="{{$winner->first_name}}"
                                                                           required/></div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Last
                                                                        Name</label>
                                                                    <input type="text"
                                                                           placeholder="Last Name"
                                                                           class="form-control"
                                                                           name="last_name"
                                                                           value="{{$winner->last_name}}"
                                                                           id="last_name"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text"
                                                                           placeholder="Email"
                                                                           class="form-control"
                                                                           id="email"
                                                                           @if(isset($winner->user->email))value="{{$winner->user->email}}"
                                                                           @endif
                                                                           name="email"/>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Prize</label><span
                                                                                    style="color:red;">*</span>
                                                                            <select class="form-control placeholder-no-fix"
                                                                                    required
                                                                                    name="prize">
                                                                                <option value="{{$winner->prize}}">@if(isset($winner->prizeName->name)){{$winner->prizeName->name}}@endif</option>
                                                                                @foreach($data['prizes'] as $prize)
                                                                                    <option value="{{$prize->id}}">{{$prize->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">Winning
                                                                            Date</label><span
                                                                                style="color:red;">*</span>

                                                                        <span class="input-append date form_datetime1">
                                                <input size="16" type="text" name="winning_date" required autocomplete="off"
                                                       class="form-control"
                                                       @if(isset($winner->winning_date)) value="{{$winner->winning_date}}"
                                                       @endif
                                                       placeholder="Winning Date">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                            </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">CNIC
                                                                            Number</label>
                                                                        <input class="form-control placeholder-no-fix"
                                                                               type="text" value="{{$winner->cnic}}"
                                                                               placeholder="CNIC Number"
                                                                               name="cnic"/>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">Account
                                                                            Number</label>
                                                                        <input class="form-control placeholder-no-fix"
                                                                               type="text" value="{{$winner->account}}"
                                                                               placeholder="Acount Number"
                                                                               name="account"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row"  style="margin-top: 12px">
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">Mobile
                                                                            Number</label>
                                                                        <input class="form-control placeholder-no-fix"
                                                                               type="text"
                                                                               placeholder="Mobile Number"
                                                                               id="user_phone"
                                                                               value="{{$winner->user_phone}}"
                                                                               name="user_phone"/>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="control-label">Social
                                                                            Links</label>
                                                                        <input class="form-control placeholder-no-fix"
                                                                               type="text"
                                                                               value="{{$winner->social_link}}"
                                                                               placeholder="Social Links"
                                                                               name="social_link"/>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Address</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text"
                                                                           value="{{$winner->address}}"
                                                                           placeholder="Address"
                                                                           name="address"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Status</label>
                                                                    <select class="form-control placeholder-no-fix"
                                                                            name="status">
                                                                        <option value="">Select Status</option>
                                                                        @foreach($data['statuses'] as $status)
                                                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Remarks</label>
                                                                    <textarea class="form-control" rows="3"
                                                                              name="question">{{$winner->question}}
                                                                        </textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
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
                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>
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
                                {{$data['winners']['winners']->links()}}
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