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
                                                            <span class="caption-subject font-blue-madison bold uppercase">Add A New Message</span>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">

                                                        <form action="{{route('admin.add-message')}}"
                                                              method="post"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Title Message
                                                                    </label>
                                                                    <input type="text"
                                                                           placeholder="Message Title"

                                                                           class="form-control"
                                                                           name="title"
                                                                           required/></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p>Note: In Message Body For line break use "%0a" or "br" tagHtml and for space use space button . Special characters like +,*,^,% not work in message sending....</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Message</label>
                                                                    <textarea class="form-control placeholder-no-fix"
                                                                              type="text" rows="6" required
                                                                              placeholder="Message Body"
                                                                              name="body"></textarea>
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
                                <input type="search" placeholder="Search ..." name="search_title"
                                       class="form-control input-sm input-small input-inline"
                                       @if(!empty(app('request')->input('search_title'))) value="{{app('request')->input('search_title')}}" @endif>

                                <input type="submit" value="Search" class="btn btn-sm green">
                            </form>

                        </div>

                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sample_1">
                        <thead>
                        <tr>
                            <th> Id</th>
                            <th> Title</th>
                            <th> Massege</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['messages']['messages'] as $message)

                            <tr class="odd gradeX">
                                <td class="center"> {{$message->id}} </td>
                                <td class="center">{{$message->title}} </td>
                                <td class="center">{{$message->body}} </td>


                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#editWinner_{{$message->id}}">
                                                    {{--<a href="{{route('admin.update-account',$winner->id)}}">--}}
                                                    <i class="icon-user"></i> View </a>
                                            </li>
                                            <li>
                                                @if($message->is_active == 0)
                                                    <a href="{{route('admin.change-message-status',$message->id)}}">
                                                        <i class="fa fa-user-plus"></i> Active </a>
                                                @else
                                                    <a href="{{route('admin.change-message-status',$message->id)}}">
                                                        <i class="fa fa-user-times"></i> DeActive </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal fade" id="editWinner_{{$message->id}}" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">

                                                    <div class="portlet-title tabbable-line">
                                                        <div class="caption caption-md">
                                                            <i class="icon-globe theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Edit Message</span>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">

                                                        <form action="{{route('admin.update-message',$message->id)}}"
                                                              method="post"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Title Message
                                                                    </label>
                                                                    <input type="text"
                                                                           placeholder="Message Title"
                                                                           value="{{$message->title}}"
                                                                           class="form-control"
                                                                           name="title"
                                                                           required/></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label ">Message</label>
                                                                    <textarea class="form-control placeholder-no-fix"
                                                                              type="text" rows="6" required
                                                                              placeholder="Message Body"
                                                                              name="body">{{$message->body}}</textarea>
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
                                {{$data['messages']['messages']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection