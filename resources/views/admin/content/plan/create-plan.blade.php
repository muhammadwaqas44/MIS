@extends('admin-layout.app')
@section('title', "Create Plan")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Content Management
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
                                <form action="{{route('admin.post-content-plan')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <label class="control-label">Topic</label><span
                                                                style="color:red;">*</span>
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
                                                        <label class="control-label">Category</label><span
                                                                style="color:red;">*</span>

                                                        <a href="#" data-toggle="modal" data-target="#myModalForcat">
                                                            <button id="sample_editable_1_new" >
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </a>


                                                        <select class="form-control" name="category_id" required>
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
                                                        <input type="file"
                                                               class="form-control"
                                                               name="source[]" multiple PLACEHOLDER="Source"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <label class="control-label">Production Schedule</label>
                                                    <div class="input-append date form_datetime">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="produce_on" placeholder="Production Date"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span>


                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <label class="control-label">Production BY</label>
                                                    <select class="form-control" name="produce_by">
                                                        <option value="">Select User</option>
                                                        @foreach($data['users'] as $user)
                                                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                                        @endforeach
                                                    </select>


                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <label class="control-label">Processing Schedule</label>
                                                    <div class="input-append date form_datetime">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="process_on" placeholder="Processing Date"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span>


                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <label class="control-label">Processing BY</label>
                                                    <select class="form-control" name="process_by">
                                                        <option value="">Select User</option>
                                                        @foreach($data['users'] as $user)
                                                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                                        @endforeach
                                                    </select>


                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <label class="control-label">Publishing Schedule</label>
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="publish_on" placeholder="Publishing Date"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span>


                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <label class="control-label">Publishing BY</label>
                                                    <select class="form-control" name="publish_by">
                                                        <option value="">Select User</option>
                                                        @foreach($data['users'] as $user)
                                                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Instruction</label>
                                                        <textarea type="text" rows="2" name="instructions"
                                                                  placeholder="Instruction"
                                                                  class="form-control"></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h3>Choose PlatForms</h3>
                                            <hr>
                                            @foreach( $data['platforms'] as $platform)
                                                <input type="checkbox" value="{{$platform->id}}"
                                                       id="defaultCheck_{{$platform->id}}" checked name="platform[]"
                                                       class="form-check-input">
                                                <label class="form-check-label"
                                                       for="defaultCheck_{{$platform->id}}">{{$platform->name}}</label>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>


                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{route('admin.all-plans')}}">
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

                        <div class="modal fade bs-modal-md" id="myModalForcat" tabindex="-1"
                             role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md" style="display: inline-block">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">Add New Category</span>
                                            </div>
                                            <div class="pull-right">
                                                <span  data-dismiss="modal" style="font-size: 20px"><i class="fa fa-times" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">

                                            <form
                                                    action="{{route('admin.add-content-cat')}}"
                                                    method="post"
                                                    enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-11">


                                                    <div class="form-group">

                                                        <input type="text"
                                                               placeholder="Category Name"
                                                               class="form-control"
                                                               name="name"
                                                               required/></div>


                                                </div>
                                                <div class="col-md-1">

                                                    <div class="margiv-top-10 pull-right">
                                                        <button type="submit"
                                                                class="btn green">
                                                            Save
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
        $(".form_datetime").datepicker({
            format: "dd MM yyyy",
            showMeridian: false,
            autoclose: true,
            todayBtn: true
        });
        $(".form_datetime1").datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
////            defaultTime : timeNow,
            autoclose: true,
            todayBtn: true
        });
    </script>
@endsection