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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Tags</label><span
                                                        style="color:red;">*</span>
                                                <textarea type="text" rows="1" name="tags"
                                                          placeholder="Tags"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Keywords</label>
                                                <textarea type="text" rows="1" name="keywords"
                                                          placeholder="Keywords"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

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
                                                <label class="control-label">Remarks</label>
                                                <textarea type="text" rows="2" name="remarks"
                                                          placeholder="Remarks"
                                                          class="form-control"></textarea>
                                            </div>

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
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection