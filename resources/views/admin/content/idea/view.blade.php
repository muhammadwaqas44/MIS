@extends('admin-layout.app')
@section('title', "Update Idea")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Content Management
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Ideas
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Update Idea
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
                        <span class="caption-subject bold uppercase">Update Idea</span>
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
                                <form action="{{route('admin.post-update-idea',$idea->id)}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @foreach($idea->c_history as $his)
                                        <input type="hidden" name="his_id" value="{{$his->id}}">
                                    @endforeach

                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <label class="control-label">Topic</label><span
                                                                style="color:red;">*</span>
                                                        <textarea type="text" rows="1" name="topic" placeholder="Topic"
                                                                  class="form-control">{{$idea->topic}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tags</label><span
                                                                style="color:red;">*</span>
                                                        <textarea type="text" rows="1" name="tags"
                                                                  placeholder="Tags"
                                                                  class="form-control">{{$idea->tags}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Keywords</label>
                                                        <textarea type="text" rows="1" name="keywords"
                                                                  placeholder="Keywords"
                                                                  class="form-control">{{$idea->keywords}}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Reference Material</label>
                                                        <textarea type="text" rows="2" name="reference_material"
                                                                  placeholder="Reference Material"
                                                                  class="form-control">{{$idea->reference_material}}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Category</label>
                                                        <select class="form-control" name="category_id" required>
                                                            @if($idea->category_id)
                                                                <option value="{{$idea->category_id}}">{{$idea->category->name}}</option> @else
                                                                <option value="">Select Category</option>
                                                            @endif
                                                            @foreach($data['category'] as $user)
                                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Instructions</label>
                                                        <textarea type="text" rows="2" name="instructions"
                                                                  placeholder="Instructions"
                                                                  class="form-control">@if($idea->instructions){{$idea->instructions}} @endif </textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Status</label>
                                                        <select class="form-control" name="status_id" required>
                                                            <option value="">Select Status</option>
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
                                                        <textarea type="text" rows="2" name="remarks"
                                                                  placeholder="Remarks"
                                                                  class="form-control"></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <h3>Platforms</h3>
                                            <hr>
                                            {{--@dd($plan->c_platformsUsed->count() == 0)--}}
                                            @if($idea->c_platformsUsed->count() != 0)
                                                @foreach( $data['platforms'] as $platform)
                                                    <input type="checkbox" value="{{$platform->id}}"
                                                           id="defaultCheck_{{$platform->id}}"
                                                           @if(in_array($platform->id, $idea->c_platformsUsed->pluck('platform_id')->toArray())) checked
                                                           @endif name="platform[]"
                                                           class="form-check-input">
                                                    <label class="form-check-label"
                                                           for="defaultCheck_{{$platform->id}}">{{$platform->name}}</label>
                                                    <br>
                                                @endforeach
                                            @else
                                                @foreach( $data['platforms'] as $platform)
                                                    <input type="checkbox" value="{{$platform->id}}"
                                                           id="defaultCheck_{{$platform->id}}" checked name="platform[]"
                                                           class="form-check-input">
                                                    <label class="form-check-label"
                                                           for="defaultCheck_{{$platform->id}}">{{$platform->name}}</label>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{route('admin.all-ideas')}}">
                                            <button type="button"
                                                    class="btn red">
                                                Cancel
                                            </button>
                                        </a>

                                    </div>
                                </form>
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
@endsection