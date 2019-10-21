@extends('admin-layout.app')
@section('title', "Edit Plan")
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
                Edit Plan
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
                        <span class="caption-subject bold uppercase">Edit Plan</span>
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
                            <div class="col-md-8">
                                <form id="plan"
                                      action="{{route('admin.edit-plan-post-update',$plan->id)}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="id" value="{{$plan->id}}">
                                    @foreach($plan->c_history as $his)
                                        <input type="hidden" name="his_id" value="{{$his->id}}">
                                    @endforeach

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <label class="control-label">Topic</label>
                                                <input type="text"
                                                       class="form-control" VALUE="{{$plan->topic}}" readonly
                                                       placeholder="Topic"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Tags</label><span
                                                        style="color:red;">*</span>
                                                <textarea type="text" rows="1"
                                                          placeholder="Tags" readonly
                                                          class="form-control">{{$plan->tags}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Keywords</label>
                                                <textarea type="text" rows="1"
                                                          placeholder="Keywords" readonly
                                                          class="form-control">{{$plan->keywords}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Reference Material</label>
                                                <textarea type="text" rows="2"
                                                          placeholder="Reference Material" readonly
                                                          class="form-control">{{$plan->reference_material}}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Category</label>
                                                {{--<a href="#" data-toggle="modal" data-target="#myModalForcat">--}}
                                                {{--<button id="sample_editable_1_new">--}}
                                                {{--<i class="fa fa-plus"></i>--}}
                                                {{--</button>--}}
                                                {{--</a>--}}
                                                <input readonly class="form-control"
                                                       value="@if($plan->category_id) {{$plan->category->name}} @else No Category @endif ">
                                                {{--<select class="form-control" name="category_id" required>--}}
                                                {{--@if($plan->category_id)--}}
                                                {{--<option value="{{$plan->category_id}}">{{$plan->category->name}}</option> @else--}}
                                                {{--<option value="">Select Category</option>--}}
                                                {{--@endif--}}
                                                {{--@foreach($data['category'] as $user)--}}
                                                {{--<option value="{{$user->id}}">{{$user->name}}</option>--}}
                                                {{--@endforeach--}}
                                                {{--</select>--}}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Instructions</label>
                                                <textarea type="text" rows="2" readonly
                                                          placeholder="Instructions"
                                                          class="form-control">@if($plan->instructions){{$plan->instructions}} @endif </textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Production Schedule</label>
                                            <div class="input-append date form_datetime">
                                                <input size="16" type="text" autocomplete="off"
                                                       VALUE="{{$plan->produce_on}}"
                                                       name="produce_on" placeholder="Production Date"
                                                       class="form-control">
                                                <span class="add-on"><i
                                                            class="icon-remove"></i></span>
                                                <span class="add-on"><i
                                                            class="icon-th"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Assign To</label>
                                            <select class="form-control" name="produce_by">
                                                @if(isset($plan->produceBy))
                                                    <option value="{{$plan->produce_by}}">{{$plan->produceBy->first_name}} {{$plan->produceBy->last_name}}</option>
                                                @else
                                                    <option value="">Select User</option>
                                                @endif
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
                                                       VALUE="{{$plan->process_on}}"
                                                       name="process_on" placeholder="Processing Date"
                                                       class="form-control">
                                                <span class="add-on"><i
                                                            class="icon-remove"></i></span>
                                                <span class="add-on"><i
                                                            class="icon-th"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Assign To</label>
                                            <select class="form-control" name="process_by">
                                                @if(isset($plan->processBy))
                                                    <option value="{{$plan->process_by}}">{{$plan->processBy->first_name}} {{$plan->processBy->last_name}}</option>
                                                @else
                                                    <option value="">Select User</option>
                                                @endif
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
                                                       VALUE="{{$plan->publish_on}}"
                                                       class="form-control">
                                                <span class="add-on"><i
                                                            class="icon-remove"></i></span>
                                                <span class="add-on"><i
                                                            class="icon-th"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Assign To</label>
                                            <select class="form-control" name="publish_by">
                                                @if(isset($plan->publishBy))
                                                    <option value="{{$plan->publish_by}}">{{$plan->publishBy->first_name}} {{$plan->publishBy->last_name}}</option>
                                                @else
                                                    <option value="">Select User</option>
                                                @endif
                                                @foreach($data['users'] as $user)
                                                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Upload Files</label>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#myModalForcat_{{$plan->id}}">
                                                    <button id="sample_editable_1_new">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                <input type="file"
                                                       class="form-control"
                                                       name="source[]" multiple PLACEHOLDER="Source"/>
                                                {{--<input type="file" name="source[]" class="form-control" multiple id="file1" onchange="uploadFile()"><br>--}}
                                                {{--<div class="progress">--}}
                                                {{--<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>--}}
                                                {{--</div>--}}
                                                <div class="progress" style="display: none">
                                                    <div class="bar"></div>
                                                    <div class="percent">0%</div>
                                                </div>

                                                {{--<div id="status"></div>--}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Status</label>
                                                <select class="form-control" name="status_id" required>
                                                    @if($plan->c_history_original->count())
                                                        @foreach($plan->c_history_original as $his)
                                                            <option value="{{$his->c_status->id}}">{{$his->c_status->name}}</option>

                                                        @endforeach
                                                    @else
                                                        <option value="">Select Status</option>
                                                    @endif
                                                    @foreach($data['statuses'] as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Remarks</label>
                                                @if($plan->c_history_original->count())
                                                    @foreach($plan->c_history_original as $his)
                                                        <textarea type="text" rows="2" name="remarks"
                                                                  placeholder="Remarks"
                                                                  class="form-control">{{$his->remarks}}</textarea>
                                                    @endforeach
                                                @else
                                                    <textarea type="text" rows="2" name="remarks"
                                                              placeholder="Remarks"
                                                              class="form-control"></textarea>
                                                @endif
                                            </div>

                                        </div>

                                    </div>


                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{route('admin.all-plans')}}">
                                            <button type="button"
                                                    class="btn red">
                                                Cancel
                                            </button>
                                        </a>

                                    </div>
                                </form>

                            </div>
                            <div class="col-md-4">
                                <h3>Platforms</h3>
                                {{--@dd($plan->c_platformsUsed->count()>0 )--}}
                                {{--                                            @if($plan->c_platformsUsed->count() != 0)--}}
                                <hr/>
                                <ul>
                                    @foreach( $data['platforms'] as $platform)
                                        <li><span style="font-size: 18px">{{$platform->name}}</span></li>
                                        {{--<input type="checkbox" value="{{$platform->id}}"--}}
                                        {{--id="defaultCheck_{{$platform->id}}"--}}
                                        {{--@if(in_array($platform->id, $plan->c_platformsUsed->pluck('platform_id')->toArray())) checked--}}
                                        {{--@endif name="platform[]"--}}
                                        {{--class="form-check-input">--}}
                                        {{--<label class="form-check-label"--}}
                                        {{--for="defaultCheck_{{$platform->id}}">{{$platform->name}}</label>--}}
                                        <br>
                                    @endforeach
                                </ul>
                                {{--@else--}}
                                {{--@foreach( $data['platforms'] as $platform)--}}
                                {{--<input type="checkbox" value="{{$platform->id}}"--}}
                                {{--id="defaultCheck_{{$platform->id}}" checked name="platform[]"--}}
                                {{--class="form-check-input">--}}
                                {{--<label class="form-check-label"--}}
                                {{--for="defaultCheck_{{$platform->id}}">{{$platform->name}}</label>--}}
                                {{--<br>--}}
                                {{--@endforeach--}}
                                {{--@endif--}}
                            </div>
                            <hr>
                            {{--<div class="col-md-8">--}}
                            {{--<form action="{{route('admin.produce-plan-history',$plan->id)}}"--}}
                            {{--method="post"--}}
                            {{--enctype="multipart/form-data">--}}
                            {{--@csrf--}}

                            {{--<div class="margiv-top-10">--}}

                            {{--<button type="submit"--}}
                            {{--class="btn green">Save--}}
                            {{--</button>--}}
                            {{--<a href="{{route('admin.all-plans')}}">--}}
                            {{--<button type="button"--}}
                            {{--class="btn red">--}}
                            {{--Cancel--}}
                            {{--</button>--}}
                            {{--</a>--}}

                            {{--</div>--}}
                            {{--</form>--}}
                            {{--</div>--}}
                        </div>
                        <div class="modal fade bs-modal-lg" id="myModalForcat_{{$plan->id}}" tabindex="-1"
                             role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md" style="display: inline-block">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">ALL MEDIA FILE</span>
                                            </div>
                                            <div class="pull-right">
                                                <span data-dismiss="modal" style="font-size: 20px"><i
                                                            class="fa fa-times" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="12">
                                                <table class="table table-bordered table-responsive-md">
                                                    @foreach($plan->media as $media)
                                                        <tr>
                                                            {{--                                                            {{dd(HumanReadable::bytesToHuman(File::size(public_path($media->media))) )}}--}}
                                                            <td class="text-left">
                                                                <span> {{HumanReadable::bytesToHuman(File::size(public_path($media->media))) }}</span><a
                                                                        target="_blank"
                                                                        href="{{route('admin.download-source-file',$media->id)}}">
                                                                    <button class="btn">{{$media->media}}</button>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
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
                                                <span data-dismiss="modal" style="font-size: 20px"><i
                                                            class="fa fa-times" aria-hidden="true"></i></span>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="sample_1">
                            <thead>
                            <tr>
                                <th> Id</th>
                                <th> Status</th>
                                {{--<th> Platform</th>--}}
                                <th> Remarks</th>
                                <th> Created By</th>
                                <th> Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $data['history'] as $his)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$his->id}} </td>
                                    <td class="center">
                                        {{$his->c_status->name}}</td>
                                    {{--<td>@if(isset($his->content->category)){{$his->content->category->name}}@endif</td>--}}

                                    <td class="center">
                                        {{$his->remarks}} </td>
                                    <td class="center">{{$his->createdByName->first_name}} {{$his->createdByName->last_name}}  </td>
                                    <td class="center">{{$his->created_at}} </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div id="waite" style="display: none; position: absolute; top: 50%;
    left: 50%;margin-top: -10px;
    margin-left: -100px;">
        <h2><img src="{{asset('/favicon/25.gif')}}" style="width: 40px; height: 40px"/> <b>Just a moment</b></h2>
    </div>
    <div class="blac-screen"
    style="width:100%;display: none;height: 100%;position: fixed;top: 0px;left: 0px;background: rgba(0,0,0,.5);">
    <div id="load" style="display: none" class="loader"></div>
    </div>
    {{--<button type="button" style="display: none" class="btn btn-primary" data-toggle="modal"--}}
            {{--data-target=".bd-example-modal-sm">Small modal--}}
    {{--</button>--}}

    {{--<div style="display: none; background-color: transparent; " class="modal fade bd-example-modal-sm" tabindex="-1"--}}
         {{--role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="waite">--}}
        {{--<div class="modal-dialog modal-sm">--}}
            {{--<div class="modal-content">--}}
                {{--<h2><img src="{{asset('/favicon/25.gif')}}" style="width: 40px; height: 40px"/> <b>Just a moment</b>--}}
                {{--</h2>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
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

    <script type="text/javascript">

        function uploadProgressHandler(event) {
            $("#loaded_n_total").html("Uploaded " + event.loaded + " bytes of " + event.total);
            var percent = (event.loaded / event.total) * 100;
            var progress = Math.round(percent);
            $(".progress").html(progress + "% uploaded... please wait");
            $(".progress").css("width", progress + "%", "background-color", progress + "blue");
//            $("#status").html(progress + "% uploaded... please wait");
        }
        $('form#plan').on('submit', function (e) {
            e.preventDefault();
            $('.progress').show();
            $('#waite').show();
            $('#load, .blac-screen').show();
//            $('#waite').modal('show');
            var id = $(this).find('#id').val();
//            alert(id);ph
            var formData = new FormData(this);
            $.ajax({

                type: 'post',
                url: '/admin/edit-plan-post/' + id,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,

                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress",
                        uploadProgressHandler,
                        false
                    );
                    return xhr;
                },
                success: function (result) {
                    console.log(result);
                    alert('Form Submit Successfully');
                    $('#load, .blac-screen').hide();
                    $('#waite').hide();
                    window.location.href = "{{route('admin.all-plans')}}";
                },
                error: function (result) {
                    alert('Form Not Submit');
                    $('#load, .blac-screen').hide();
                    $('#waite').hide();
                    $('#waite').modal('hide');
                }
            });
        });

    </script>

@endsection