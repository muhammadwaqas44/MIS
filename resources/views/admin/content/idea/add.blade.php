@extends('admin-layout.app')
@section('title', "Create Idea")
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
                Create Idea
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
                        <span class="caption-subject bold uppercase">Create Idea</span>
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
                                <form action="{{route('admin.post-idea')}}"
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
                                                        <textarea type="text" rows="1" name="topic" placeholder="Topic"
                                                                  class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label">Tags</label><span--}}
                                                                {{--style="color:red;">*</span>--}}
                                                        {{--<textarea type="text" rows="1" name="tags"--}}
                                                                  {{--placeholder="Tags"--}}
                                                                  {{--class="form-control"></textarea>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label">Keywords</label>--}}
                                                        {{--<textarea type="text" rows="1" name="keywords"--}}
                                                                  {{--placeholder="Keywords"--}}
                                                                  {{--class="form-control"></textarea>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Reference Material</label>
                                                        <textarea type="text" rows="2" name="reference_material"
                                                                  placeholder="Reference Material"
                                                                  class="form-control"></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Category</label>
                                                        <a href="#" data-toggle="modal" data-target="#myModalForcat">
                                                            <button id="sample_editable_1_new">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </a>

                                                        <select class="form-control" name="category_id" required>
                                                            <option value="">Select Category</option>
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
                                                                  class="form-control"></textarea>
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

            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection