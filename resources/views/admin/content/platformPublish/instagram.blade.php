@extends('admin-layout.app')
@section('title', "Create Expense")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Expenses
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Produce Plan
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Create Instagram Content
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
                        <span class="caption-subject bold uppercase">for Instagram</span>
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
                                <form id="form"
                                      action="{{route('admin.post-expense-add')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Topic</label>
                                                <input type="text" class="form-control" readonly
                                                       value=" {{$content->topic}}"
                                                       placeholder="topic">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Category</label>
                                                <input type="text" class="form-control" readonly
                                                       value=" {{$content->category->name}}"
                                                       placeholder="topic">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <label class="control-label">Title</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="title" placeholder="Title"
                                                       required/>

                                            </div>
                                            <div class="col-md-6">
                                                <label>HashTags</label>
                                                <input type="text" class="form-control" name="hash_tags"
                                                       placeholder="HashTags">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <textarea type="text" rows="3" name="description"
                                                          placeholder="Description"
                                                          class="form-control"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Media</label>
                                                <input type="file" class="form-control" name="media"
                                                       placeholder="File Upload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Remarks</label>
                                                <textarea type="text" rows="3" name="description"
                                                          placeholder="Remarks"
                                                          class="form-control"></textarea>
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
                        </div>

                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection