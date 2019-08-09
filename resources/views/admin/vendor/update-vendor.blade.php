@extends('admin-layout.app')
@section('title', "Update Vendor")
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
                                <form method="post" action="{{route('admin.update-vendor-post',$vendor->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Edit Details</h4><br>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <label class="control-label">Name</label><span
                                                            style="color:red;">*</span>
                                                    <input type="text" name="name" class="form-control" required
                                                           placeholder="Name" value="{{$vendor->name}}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Contact Number Primary</label>
                                                    <input type="text" name="contact_no_primary" class="form-control"
                                                           placeholder="Contact Number Primary"
                                                           value="{{$vendor->contact_no_secondary}}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Contact Number Secondary</label>
                                                    <input type="text" name="contact_no_secondary" class="form-control"
                                                           placeholder="Contact Number Secondary"
                                                           value="{{$vendor->name}}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Land Line</label>
                                                    <input type="text" name="landline" class="form-control"
                                                           placeholder="Land Line" value="{{$vendor->landline}}"
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
                                                           placeholder="Address" value="{{$vendor->address}}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label"> City</label>
                                                    <select name="city_id" class="form-control">
                                                        <option value="{{$vendor->city_id}}">{{$vendor->city->name}}</option>
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
                                                        <option value="{{$vendor->professional_id}}">{{$vendor->professional->name}}</option>
                                                        @foreach( $data['professional']  as $professional)
                                                            <option value="{{$professional->id}}">{{$professional->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label"> Attach File</label> <span
                                                            id="show" style="color: blue; display:none;">{{$vendor->attech_file}}</span>
                                                    <input type="file" name="attech_file" class="form-control" id="hover"/>
                                                    <input type="hidden" name="attech_file_hile" class="form-control"
                                                           value="{{$vendor->attech_file}}"
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
                                                      class="form-control">{{$vendor->remarks}}</textarea>
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
    <script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $("#hover").hover(function(){
            $('#show').show();
        },function(){
            $('#show').hide();
        });
    </script>
@endsection