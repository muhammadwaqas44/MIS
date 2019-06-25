@extends('admin-layout.app')
@section('title', "All Messages")
@section('content')


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Messages Response Table</span>
                    </div>
                    {{--<div class="actions">--}}
                    {{--<div class="btn-group btn-group-devided" data-toggle="buttons">--}}
                    {{--<label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">--}}
                    {{--<input type="radio" name="options" class="toggle" id="option1">Actions</label>--}}
                    {{--<label class="btn btn-transparent dark btn-outline btn-circle btn-sm">--}}
                    {{--<input type="radio" name="options" class="toggle" id="option2">Settings</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="portlet-body">

                    <div class="table-toolbar">

                        <div id="sample_1_filter" class="dataTables_filter">
                            <label>Search:</label>
                            <form>
                                <input type="search" placeholder="Search..." name="search_title"
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
                            <th>Id</th>
                            <th> Recipient No</th>
                            <th> Message Body</th>
                            <th> Sent By</th>
                            <th> Status</th>
                            <th> Reference</th>
                            <th> Masking</th>
                            <th> Sent On</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['responses']['responses'] as $response)
                            <tr class="odd gradeX">
                                <td class="center"> {{$response->id}} </td>
                                <td class="center"> {{$response->recipient_no}}</td>
                                <td class="center">{{ str_limit($response->body, $limit = 60, $end = '...') }}</td>
                                <td class="center">{{$response->sentBy->first_name}} {{$response->sentBy->last_name}}</td>
                                <td class="center">{{$response->status}}</td>
                                <td class="center">{{$response->reference}}</td>
                                <td class="center">{{$response->masking}}</td>
                                <td class="center">{{$response->sent_on}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">

                        <div class="col-md-7 col-sm-7">
                            <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
                                {{$data['responses']['responses']->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection