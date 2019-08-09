@extends('admin-layout.app')
@section('title', "Add Vendor")
@section('content')


    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Add Vendor</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{route('admin.add-vendor-post')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Add Details</h4><br>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <label class="control-label">Name</label><span
                                                            style="color:red;">*</span>
                                                    <input type="text" name="name" class="form-control" required
                                                           placeholder="Name"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Contact Number Primary</label>
                                                    <input type="text" name="contact_no_primary" class="form-control"
                                                           placeholder="Contact Number Primary"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Contact Number Secondary</label>
                                                    <input type="text" name="contact_no_secondary" class="form-control"
                                                           placeholder="Contact Number Secondary"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Land Line</label>
                                                    <input type="text" name="landline" class="form-control"
                                                           placeholder="Land Line"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <br><br><br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label"> Address</label>
                                                    <input type="text" name="address" class="form-control"
                                                           placeholder="Address"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label"> City</label>
                                                    <select name="city_id" class="form-control">
                                                        <option value="">Select City</option>
                                                        @foreach( $data['city']  as $city)
                                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label"> Professional</label>
                                                    <select name="professional_id" class="form-control">
                                                        <option value="">Select professional</option>
                                                        @foreach( $data['professional']  as $professional)
                                                            <option value="{{$professional->id}}">{{$professional->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label"> Attach File</label>
                                                    <input type="file" name="attech_file" class="form-control" s
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Remarks</label>
                                            <textarea type="text" name="remarks" rows="2"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button TYPE="submit" class="btn green-dark">Save</button>
                                            <a href="{{route('admin.all-vendors')}}" class="btn btn-outline-info"
                                               style="background-color:lightgray ">
                                                Cancel
                                            </a>
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