@extends('admin-layout.app')
@section('title', "Process-YouTube")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                CMT
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Process
                <i class="fa fa-circle"></i>
            </li>
            <li>
                YouTube
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
                        <span class="caption-subject bold uppercase">Youtube</span>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Topic</label>
                                            <input type="text" class="form-control" readonly
                                                   value=" {{$content->topic}}"
                                                   placeholder="topic">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <input type="text" class="form-control" readonly
                                                   value=" {{$content->category->name}}"
                                                   placeholder="topic">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Title</label>
                                            <textarea type="text" rows="1" readonly
                                                      placeholder="Title"
                                                      class="form-control">@if(isset($content->youtube)) {{$content->youtube->title}} @endif</textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tags</label>
                                            <textarea type="text" rows="1" readonly
                                                      placeholder="Tags"
                                                      class="form-control">@if(isset($content->youtube)) {{$content->youtube->tags}} @endif</textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label>HashTags</label>
                                            <textarea type="text" rows="1"
                                                      placeholder="HashTags" readonly
                                                      class="form-control">@if(isset($content->youtube)) {{$content->youtube->hash_tags}} @endif</textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label>PlayList</label>
                                            <textarea type="text" rows="1"
                                                      placeholder="Playlist" readonly
                                                      class="form-control">@if(isset($content->youtube)) {{$content->youtube->playlist}} @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>View Access</label>
                                            <input readonly
                                                   @if(isset($content->youtube->viewAccess))  value="{{$content->youtube->viewAccess->name}} "
                                                   @endif class="form-control">
                                            {{--<select class="form-control" name="view_access_id" required>--}}
                                            {{--<option value="">Select View Access</option>--}}
                                            {{--@foreach( $data['youtube_views'] as $view)--}}
                                            {{--<option value="{{$view->id}}">{{$view->name}}</option>--}}
                                            {{--@endforeach--}}
                                            {{--</select>--}}
                                        </div>
                                        <div class="col-md-4">
                                            <label>License</label>
                                            <input readonly
                                                   @if(isset($content->youtube->license)) value="{{$content->youtube->license->name}} "
                                                   @endif class="form-control">
                                            {{--<select class="form-control" name="license_id" required>--}}
                                            {{--<option value="">Select License</option>--}}
                                            {{--@foreach( $data['youtube_licenses'] as $licens)--}}
                                            {{--<option value="{{$licens->id}}">{{$licens->name}}</option>--}}
                                            {{--@endforeach--}}
                                            {{--</select>--}}
                                        </div>
                                        <div class="col-md-4">
                                            <label>End Screen Notation</label>
                                            <textarea type="text" rows="1" class="form-control" readonly
                                                      placeholder="End Screen Notation">@if(isset($content->youtube)) {{$content->youtube->end_screen}} @endif</textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <label>Weblinks in video description</label>
                                            <textarea type="text" rows="1" readonly
                                                      placeholder="Weblinks in video description"
                                                      class="form-control">@if(isset($content->youtube)) {{$content->youtube->web_links}} @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea type="text" rows="3" readonly
                                                      placeholder="Description"
                                                      class="form-control">@if(isset($content->youtube)) {{$content->youtube->description}} @endif</textarea>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <form id="form"
                                      action="{{route('admin.post-youtube-add-process')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="used_platform_id" value="{{$platUsedId}}">
                                    <input type="hidden" name="plan_id" value="{{$content->id}}">
                                    @if(isset($content->youtube))
                                        <input type="hidden" name="youtube_id" value="{{$content->youtube->id}}">
                                    @endif

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Upload Files</label>

                                                <a href="#" data-toggle="modal"
                                                   data-target="#myModalForcat_{{$content->id}}">
                                                    <button id="sample_editable_1_new">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                <input type="file" name="media[]" multiple class="form-control">
                                            </div>
                                            {{--<div class="col-md-6">--}}
                                            {{--<label>Thumbnail</label>--}}
                                            {{--<input type="file" name="thumbnail[]" multiple class="form-control">--}}
                                            {{--</div>--}}
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Status</label>
                                                    <select class="form-control" name="c_status_id" required>
                                                        @if(isset($content->c_history_process)) @foreach($content->c_history_process->where('platform_used_id',2) as $status)
                                                            <option value="{{$status->c_status_id}}">{{$status->c_status->name}}</option>
                                                        @endforeach
                                                        @else
                                                            <option value="">Select status</option>
                                                        @endif
                                                        @foreach( $data['statuses'] as $licens)
                                                            <option value="{{$licens->id}}">{{$licens->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Remarks</label>
                                                    @if($content->c_history_process->count() >0)
                                                        @if(isset($content->c_history_process))
                                                            @foreach($content->c_history_process->where('platform_used_id',2) as $status)
                                                                <textarea type="text" rows="3" name="remarks"
                                                                          placeholder="Remarks"
                                                                          class="form-control">{{$status->remarks}}</textarea>
                                                            @endforeach
                                                        @else
                                                            <textarea type="text" rows="3" name="remarks"
                                                                      placeholder="Remarks"
                                                                      class="form-control"></textarea>
                                                        @endif
                                                    @else
                                                        <textarea type="text" rows="3" name="remarks"
                                                                  placeholder="Remarks"
                                                                  class="form-control"></textarea>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{ URL::previous() }}">
                                            <button type="button" class="btn red">Cancel</button>
                                        </a>

                                    </div>
                                </form>
                                <hr>
                                {{--<form id="form"--}}
                                {{--action="{{route('admin.post-youtube-status-process')}}"--}}
                                {{--method="post"--}}
                                {{--enctype="multipart/form-data">--}}
                                {{--@csrf--}}
                                {{--<input type="hidden" name="platform_id" value="{{$platFormId}}">--}}
                                {{--<input type="hidden" name="plan_id" value="{{$content->id}}">--}}


                                {{--<div class="form-group">--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                {{--<label>Status</label>--}}
                                {{--<select class="form-control" name="c_status_id" required>--}}
                                {{--<option value="">Select status</option>--}}
                                {{--@foreach( $data['statuses'] as $licens)--}}
                                {{--<option value="{{$licens->id}}">{{$licens->name}}</option>--}}
                                {{--@endforeach--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                {{--<label>Remarks</label>--}}
                                {{--<textarea type="text" rows="3" name="remarks"--}}
                                {{--placeholder="Remarks"--}}
                                {{--class="form-control"></textarea>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="margiv-top-10">--}}

                                {{--<button type="submit"--}}
                                {{--class="btn green">Save--}}
                                {{--</button>--}}
                                {{--<a href="{{route('admin.all-content-generation')}}">--}}
                                {{--<button type="button"--}}
                                {{--class="btn red">--}}
                                {{--Cancel--}}
                                {{--</button>--}}
                                {{--</a>--}}

                                {{--</div>--}}
                                {{--</form>--}}
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
            <div class="modal fade bs-modal-lg" id="myModalForcat_{{$content->id}}" tabindex="-1"
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
                                        @foreach($content->mediaYoutube as $media)
                                            <tr>

                                                <td class="text-left">
                                                    <span> {{HumanReadable::bytesToHuman(File::size(public_path($media->media))) }}</span>
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

            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection