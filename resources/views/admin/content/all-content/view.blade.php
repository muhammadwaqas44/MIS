@extends('admin-layout.app')
@section('title', "Upload Content")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Content Management
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Publish
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Upload Content
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
                        <span class="caption-subject bold uppercase">Upload Content</span>
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
                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="{{route('admin.content-publish-post',$plan->id)}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @foreach($plan->c_history_original as $his)
                                                <input type="hidden" value="{{$his->id}}" name="his_id">
                                            @endforeach
                                            <div class="form-group">
                                                <label class="control-label">Topic</label>
                                                {{--                                                {{$plan->topic}}--}}
                                                <input readonly value="{{$plan->topic}}" class="form-control">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tags</label>
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
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label class="control-label">Category
                                                        </label>
                                                        <input readonly
                                                               value="@if(isset($plan->category)){{$plan->category->name}} @else No Category Selected @endif"
                                                               class="form-control">
                                                        {{--                                                        {{$plan->category->name}}--}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Download Files</label>
                                                        <a href="#" data-toggle="modal"
                                                           data-target="#myModalForcat_{{$plan->id}}">
                                                            <button id="sample_editable_1_new">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <input readonly value="{{$plan->media->count()}} Files"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Instructions</label>
                                                        <textarea type="text" rows="2"
                                                                  placeholder="Instructions"
                                                                  readonly
                                                                  class="form-control">{{$plan->instructions}}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <label class="control-label">Production Schedule</label>
                                                    {{--<div class="input-append date form_datetime">--}}
                                                    <input size="16" readonly autocomplete="off"
                                                           VALUE="{{$plan->produce_on}}"
                                                           name="produce_on" placeholder="Production Date"
                                                           class="form-control">
                                                    {{--<span class="add-on"><i--}}
                                                    {{--class="icon-remove"></i></span>--}}
                                                    {{--<span class="add-on"><i--}}
                                                    {{--class="icon-th"></i></span>--}}
                                                    {{--</div>--}}
                                                </div>
                                                <div class="col-md-6">

                                                    <label class="control-label">Assign To</label>
                                                    <input readonly
                                                           value="@if(isset($plan->produceBy)){{$plan->produceBy->first_name}} {{$plan->produceBy->last_name}} @else No User @endif"
                                                           class="form-control">
                                                    <input name="produce_by" type="hidden"
                                                           @if(isset($plan->produceBy)) value="{{$plan->produceBy->id}}"
                                                           @endif
                                                           class="form-control">
                                                    {{--<select class="form-control" name="produce_by">--}}
                                                    {{--@if(isset($plan->produceBy))--}}
                                                    {{--<option value="{{$plan->produce_by}}">{{$plan->produceBy->first_name}} {{$plan->produceBy->last_name}}</option>--}}
                                                    {{--@else--}}
                                                    {{--<option value="">Select User</option>--}}
                                                    {{--@endif--}}
                                                    {{--@foreach($data['users'] as $user)--}}
                                                    {{--<option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>--}}
                                                    {{--@endforeach--}}
                                                    {{--</select>--}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <label class="control-label">Processing Schedule</label>
                                                    <div class="input-append date ">
                                                        <input size="16" type="text" autocomplete="off"
                                                               VALUE="{{$plan->process_on}}" readonly name="process_on"
                                                               placeholder="Processing Date"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span>


                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <label class="control-label">Assign To</label>

                                                    <input readonly
                                                           value="@if(isset($plan->processBy)){{$plan->processBy->first_name}} {{$plan->processBy->last_name}} @else No User @endif"
                                                           class="form-control">
                                                    <input name="process_by" type="hidden"
                                                           @if(isset($plan->processBy)) value="{{$plan->processBy->id}}"
                                                           @endif
                                                           class="form-control">
                                                    {{--<select class="form-control" name="process_by">--}}
                                                    {{--@if(isset($plan->processBy))--}}
                                                    {{--<option value="{{$plan->process_by}}">{{$plan->processBy->first_name}} {{$plan->processBy->last_name}}</option>--}}
                                                    {{--@else--}}
                                                    {{--<option value="">Select User</option>--}}
                                                    {{--@endif--}}
                                                    {{--@foreach($data['users'] as $user)--}}
                                                    {{--<option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>--}}
                                                    {{--@endforeach--}}
                                                    {{--</select>--}}
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
                                            <div class="col-md-8">
                                                <div class="margiv-top-10">

                                                    <button type="submit"
                                                            class="btn green">Save
                                                    </button>
                                                    <a href="{{ URL::previous() }}">
                                                        <button type="button" class="btn red">Cancel</button>
                                                    </a>

                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="col-md-4">
                                        <h3>Platforms</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th>
                                                                Platforms
                                                            </th>
                                                            <th>
                                                                Status
                                                            </th>
                                                            {{--<th>--}}
                                                            {{--SEO--}}
                                                            {{--</th>--}}
                                                        </tr>
                                                        {{--@dd($plan->c_history_process->where('platform_used_id',2), $plan->c_history->where(['type_module'=>1,'platform_used_id'=> 2]))--}}
                                                        @foreach( $plan->c_platformsUsed as $item)
                                                            <tr>

                                                                <td>
                                                                    <a href="{{route('admin.platform-publish',['platUsedId'=>$item->id,'planId'=>$item->plan_id,'platFormId'=>$item->platform_id,])}}"
                                                                       class="btn">
                                                                        {{$item->c_platforms->name}}
                                                                    </a>
                                                                </td>

                                                                <td>
                                                                    @if($plan->c_history_process->count()> 0)
                                                                        @if($plan->c_history_process->where('platform_used_id',$item->platform_id)->count() >0)
                                                                            @foreach($plan->c_history_process->where('platform_used_id',$item->platform_id) as $status)
                                                                                @if(isset($status->c_status))
                                                                                    {{$status->c_status->name}}
                                                                                @else
                                                                                    Pending
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            Pending
                                                                        @endif
                                                                    @else
                                                                        Pending
                                                                    @endif
                                                                </td>
                                                                {{--<td>--}}
                                                                {{--@if($plan->c_history_seo->count()> 0)--}}
                                                                {{--@if($plan->c_history_seo->where('platform_used_id',$item->platform_id)->count() >0)--}}
                                                                {{--@foreach($plan->c_history_seo->where('platform_used_id',$item->platform_id) as $status)--}}
                                                                {{--@if(isset($status->c_status))--}}
                                                                {{--{{$status->c_status->name}}--}}
                                                                {{--@else--}}
                                                                {{--Pending--}}
                                                                {{--@endif--}}
                                                                {{--@endforeach--}}
                                                                {{--@else--}}
                                                                {{--Pending--}}
                                                                {{--@endif--}}
                                                                {{--@else--}}
                                                                {{--Pending--}}
                                                                {{--@endif--}}
                                                                {{--</td>--}}
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>


                                        </div>

                                        {{--@foreach( $plan->c_platformsUsed as $item)--}}
                                        {{--<a href="{{route('admin.platform-page',['platUsedId'=>$item->id,'planId'=>$item->plan_id,'platFormId'=>$item->platform_id,])}}"--}}
                                        {{--class="btn btn-outline-info">--}}
                                        {{--{{$item->c_platforms->name}}</a>--}}
                                        {{--<br>--}}
                                        {{--@endforeach--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

                                                <td class="text-left">
                                                    <a target="_blank"
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

            <!-- END EXAMPLE TABLE PORTLET -->
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
            format: "dd MM yyyy",
            showMeridian: false,
////            defaultTime : timeNow,
            autoclose: true,
            todayBtn: true
        });
    </script>
@endsection