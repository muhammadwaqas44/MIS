@extends('admin-layout.app')
@section('title', "Edit Job Application")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Hiring
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Job Application
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Update Job Application
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
                        <span class="caption-subject bold uppercase">Edit Job Application</span>
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
                                <form action="{{route('admin.update-job-application',$jobApplication->id)}}"
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
                                                       value="{{$jobApplication->name}}"
                                                       required/>
                                            </div>
                                            <div class="col-md-6">

                                                <label class="control-label">Email</label>
                                                <input type="email"
                                                       class="form-control"
                                                       name="email"
                                                       value="{{$jobApplication->email}}"
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
                                                       value="{{$jobApplication->user_phone}}"
                                                       required/></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{$jobApplication->city_name}}"
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
                                                       value="{{$jobApplication->address}}"
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
                                                       @if(isset($jobApplication->skype_id))value="{{$jobApplication->skype_id}}" @endif
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
                                                       @if(isset($jobApplication->expected_salary))value="{{$jobApplication->expected_salary}}" @endif
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <select name="designation_id"
                                                        required class="form-control">
                                                    @if($jobApplication->designation_id)
                                                        <option value="{{$jobApplication->designation_id}}">{{$jobApplication->designation->name}}</option>
                                                    @else
                                                        <option value="">
                                                            Select
                                                            Position
                                                        </option>
                                                    @endif
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
                                                    @if($jobApplication->channel_id)
                                                        <option value="{{$jobApplication->channel_id}}">{{$jobApplication->channel->name}}
                                                        </option>
                                                    @else
                                                        <option value="">
                                                            Select
                                                            Channel
                                                        </option>
                                                    @endif
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
                                                    @if($jobApplication->experience_id)
                                                        <option value="{{$jobApplication->experience_id}}">{{$jobApplication->experience->name}}
                                                        </option>
                                                    @else
                                                        <option value="">
                                                            Select
                                                            Experience
                                                        </option>
                                                    @endif
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
                                                @if($jobApplication->resume)
                                                    <a target="_blank"
                                                       href="{{route('admin.download-resume',$jobApplication->id)}}"
                                                       id="hover">
                                                        <i class="icon-paper-clip"></i>
                                                    </a>
                                                @endif
                                                <span
                                                        id="show"
                                                        style="color: blue; display:none;">{{$jobApplication->resume}}</span>
                                                <input type="file"
                                                       class="form-control"
                                                       name="resume"
                                                       value="{{$jobApplication->resume}}"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($jobApplication->apply_for))
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Apply For</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="apply_for"
                                                           value="{{$jobApplication->apply_for}}"
                                                    />
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Remarks</label>
                                                <textarea type="text" rows="2"
                                                          name="remarks"
                                                          class="form-control">@foreach($jobApplication->history as $histroy)@if(isset($histroy->remarks)){{$histroy->remarks}}@endif @endforeach</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($jobApplication->history as $histroy)
                                        @if(isset($histroy->id))
                                            <input type="hidden" name="his_id"
                                                   value="{{$histroy->id}}">
                                        @endif
                                    @endforeach
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
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th> Name</th>
                                            <th> Status</th>
                                            <th> Position</th>
                                            <th> Date & Time</th>
                                            <th> Remarks</th>
                                            <th> Updated by</th>
                                            <th> Updated At</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data['updatedSchedules']->where('job_id', '=', $jobApplication->id) as $updatedSchedule)
                                            <tr class="odd gradeX">
                                                <td class="center"> {{$updatedSchedule->id}} </td>
                                                <td> {{$updatedSchedule->applicant->name}}</td>
                                                @if(isset($updatedSchedule->status->name))
                                                    <td class="center">{{$updatedSchedule->status->name}}</td>
                                                @else
                                                    <td class="center">No Status</td>
                                                @endif
                                                <td class="center">{{$updatedSchedule->applicant->designation->name}}</td>
                                                <td class="center">{{$updatedSchedule->dateTime}}</td>
                                                <td class="center">{{$updatedSchedule->remarks}}</td>
                                                <td class="center">{{$updatedSchedule->user->first_name}} {{$updatedSchedule->user->last_name}} </td>
                                                <td class="center">{{$updatedSchedule->created_at}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        $("#hover").hover(function () {
            $('#show').show();
        }, function () {
            $('#show').hide();
        });
    </script>
@endsection