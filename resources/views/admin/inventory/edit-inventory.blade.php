@extends('admin-layout.app')
@section('title', "Edit Plan")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Inventory Management
                <i class="fa fa-circle"></i>
            </li>
            <li>
                All Inventory
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Edit Inventory
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
                        <span class="caption-subject bold uppercase">Edit Inventory</span>
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
                                <form action="{{route('admin.post-inventory-update',$inventory->id)}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Inventory Type</label><span style="color:red;">*</span>
                                                <select class="form-control" name="type_id" required>
                                                    <option value="{{$inventory->type_id}}">{{$inventory->typeName->name}}</option>
                                                    @foreach($data['type'] as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Specification</label><span style="color:red;">*</span>
                                                <input type="text"
                                                       class="form-control" value="{{$inventory->specification}}"
                                                       name="specification" placeholder="Specification"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Note</label>
                                                <textarea type="text" rows="3" name="note"
                                                          placeholder="Note"
                                                          class="form-control">{{$inventory->note}}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{route('admin.all-inventories')}}">
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