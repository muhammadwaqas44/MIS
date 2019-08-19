@extends('admin-layout.app')
@section('title', "Add Job Application")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="#">Hiring</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Job Application</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Add Job Application</a>
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
                        <span class="caption-subject bold uppercase">Add Job Application</span>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.post-job-application')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <label class="control-label">Name</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="name"
                                                       required/>
                                            </div>
                                            <div class="col-md-6">

                                                <label class="control-label">Email</label>
                                                <input type="email"
                                                       class="form-control"
                                                       name="email"
                                                       required/></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="user_phone"
                                                       required/></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="city_name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="address"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Skype ID</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="skype_id"
                                                />

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Expected
                                                    Salary</label>
                                                <input type='text'
                                                       class="form-control"
                                                       name="expected_salary"
                                                />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <select name="designation_id" required
                                                        class="form-control">
                                                    <option value="">Select
                                                        Designation
                                                    </option>
                                                    @foreach($data['designation'] as  $designation)
                                                        <option value="{{$designation->id}}">
                                                            {{$designation->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Channels</label>
                                                <select name="channel_id"
                                                        class="form-control">
                                                    <option value="">Select
                                                        Channel
                                                    </option>
                                                    @foreach($data['channels'] as  $channel)
                                                        <option value="{{$channel->id}}">
                                                            {{$channel->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Experience</label>
                                                <select name="experience_id"
                                                        class="form-control">
                                                    <option value="">Select
                                                        Experience
                                                    </option>
                                                    @foreach($data['experience'] as  $experience)
                                                        <option value="{{$experience->id}}">
                                                            {{$experience->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Resume</label>
                                                <input type="file"
                                                       class="form-control"
                                                       name="resume"
                                                       required/>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Remarks</label>
                                                <textarea type="text" rows="2" name="remarks"
                                                          class="form-control"></textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{route('admin.all-job-application')}}">
                                            <button type="button"
                                                    class="btn red"
                                                    data-dismiss="modal">
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