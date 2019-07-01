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
                                    <div class="modal fade" id="myModalForWinner" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog">
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


                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">CNIC
                                                                        Number</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text"
                                                                           placeholder="CNIC Number"
                                                                           name="cnic"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Account
                                                                        Number</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text"
                                                                           placeholder="Acount Number"
                                                                           name="account"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Prize</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text"
                                                                           placeholder="Prize"
                                                                           name="prize"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Social Links</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text"
                                                                           placeholder="Social Links"
                                                                           name="social_link"/>
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
                                                                    <label class="control-label ">Status</label>
                                                                    <select class="form-control placeholder-no-fix"
                                                                            name="status">
                                                                        <option value=""> Select Status</option>
                                                                        <option value="yes"> Yes</option>
                                                                        <option value="no"> No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Question</label>
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
                            <th> Address</th>
                            <th> Social Link</th>
                            <th> Status</th>
                            <th> Prize</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['winners']['winners'] as $winner)

                            <tr class="odd gradeX">
                                <td class="center"> {{$winner->id}} </td>
                                <td> {{$winner->user->first_name}} {{$winner->user->last_name}}</td>
                                <td>
                                    <a href="mailto:{{$winner->user->email}}"> {{$winner->user->email}}</a>
                                </td>

                                <td class="center">{{$winner->user->user_phone}}</td>
                                <td class="center">{{$winner->user->address}}</td>
                                <td class="center"><a href="{{$winner->social_link}} " style="color: black"><i
                                                class="fa fa-internet-explorer"></i> Social Media Link</a></td>
                                <td class="center">{{$winner->status}}</td>
                                <td class="center">{{$winner->prize}}</td>
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
                                    <div class="modal fade" id="editWinner_{{$winner->id}}" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog">
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

                                                                <input type="hidden" value="{{$winner->user->id}}"
                                                                       name="user_id">
                                                                <div class="form-group">
                                                                    <label class="control-label">First
                                                                        Name</label>
                                                                    <input type="text"
                                                                           placeholder="First Name"
                                                                           id="first_name"
                                                                           class="form-control"
                                                                           name="first_name"
                                                                           value="{{$winner->user->first_name}}"
                                                                           required/></div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Last
                                                                        Name</label>
                                                                    <input type="text"
                                                                           placeholder="Last Name"
                                                                           class="form-control"
                                                                           name="last_name"
                                                                           value="{{$winner->user->last_name}}"
                                                                           id="last_name"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text"
                                                                           placeholder="Email"
                                                                           class="form-control"
                                                                           id="email" value="{{$winner->user->email}}"
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
                                                                           value="{{$winner->user->user_phone}}"
                                                                           name="user_phone"/>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">CNIC
                                                                        Number</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text" value="{{$winner->cnic}}"
                                                                           placeholder="CNIC Number"
                                                                           name="cnic"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Account
                                                                        Number</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text" value="{{$winner->account}}"
                                                                           placeholder="Acount Number"
                                                                           name="account"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Prize</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text" value="{{$winner->prize}}"
                                                                           placeholder="Prize"
                                                                           name="prize"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Social Links</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text" value="{{$winner->social_link}}"
                                                                           placeholder="Social Links"
                                                                           name="social_link"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Address</label>
                                                                    <input class="form-control placeholder-no-fix"
                                                                           type="text"
                                                                           value="{{$winner->user->address}}"
                                                                           placeholder="Address"
                                                                           name="address"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Status</label>
                                                                    <select class="form-control placeholder-no-fix"
                                                                            name="status">
                                                                        <option value="{{$winner->status}}">{{$winner->status}}</option>
                                                                        <option value="yes"> Yes</option>
                                                                        <option value="no"> No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Question</label>
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
@endsection