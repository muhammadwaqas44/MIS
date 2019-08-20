@extends('admin-layout.app')
@section('title', "Add Job Application")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Content
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Plan
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Create Plan
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
                        <span class="caption-subject bold uppercase">Create Plan</span>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.post-job-application')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <label class="control-label">Topic</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="topic" placeholder="Topic"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Category</label>
                                                <select class="form-control">
                                                    <option>Select Category</option>
                                                    @foreach($data['category'] as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Source</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="source" PLACEHOLDER="Source"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Remarks</label>
                                                <textarea type="text" rows="2" name="remarks" placeholder="Remarks"
                                                          class="form-control"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Production Schedule</label>
                                                <div class="input-append date form_datetime1">
                                                    <input size="16" type="text" autocomplete="off" required
                                                           name="joining_date" placeholder="Production Date"
                                                           class="form-control">
                                                    <span class="add-on"><i
                                                                class="icon-remove"></i></span>
                                                    <span class="add-on"><i
                                                                class="icon-th"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Production BY</label>
                                                <select class="form-control">
                                                    <option>Select User</option>
                                                    @foreach($data['users'] as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name}}{{$user->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Processing Schedule</label>
                                                <div class="input-append date form_datetime1">
                                                    <input size="16" type="text" autocomplete="off" required
                                                           name="joining_date" placeholder="Processing Date"
                                                           class="form-control">
                                                    <span class="add-on"><i
                                                                class="icon-remove"></i></span>
                                                    <span class="add-on"><i
                                                                class="icon-th"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Processing BY</label>
                                                <select class="form-control">
                                                    <option>Select User</option>
                                                    @foreach($data['users'] as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name}}{{$user->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Publishing Schedule</label>
                                                <div class="input-append date form_datetime1">
                                                    <input size="16" type="text" autocomplete="off" required
                                                           name="joining_date" placeholder="Publishing Date"
                                                           class="form-control">
                                                    <span class="add-on"><i
                                                                class="icon-remove"></i></span>
                                                    <span class="add-on"><i
                                                                class="icon-th"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Publishing BY</label>
                                                <select class="form-control">
                                                    <option>Select User</option>
                                                    @foreach($data['users'] as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name}}{{$user->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{route('admin.all-job-application')}}">
                                            <button type="button"
                                                    class="btn red"
                                                    data-dismiss="modal">
                                                Cancel
                                            </button>
                                        </a>

                                    </div>
                                </form>
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
//        $(".form_datetime1").datepicker({
//            format: "dd/mm/yyyy - HH:ii P",
//            showMeridian: false,
//            autoclose: true,
//            todayBtn: "linked"
//        });
        $(".form_datetime1").datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
////            defaultTime : timeNow,
            autoclose: true,
            todayBtn: true
        });
    </script>
@endsection