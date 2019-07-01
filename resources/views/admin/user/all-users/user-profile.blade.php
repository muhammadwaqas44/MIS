@extends('admin-layout.app')
@section('title', "My Profile")
@section('content')


    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light ">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">My Profile</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <form action="{{route('admin.update-my-profile-post', $data['user']->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" placeholder="First Name" value="{{ $data['user']->first_name}}"
                                           class="form-control" name="first_name" required/></div>
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" placeholder="Last Name" value="{{ $data['user']->last_name}}"
                                           class="form-control" required name="last_name"/></div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" placeholder="Email" value="{{ $data['user']->email}}"
                                           class="form-control" required name="email"/></div>
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="text" placeholder="Password" class="form-control" name="password"
                                           required/></div>

                                <div class="form-group">
                                    <label class="control-label ">Address</label>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="Address"
                                           value="{{ $data['user']->address}}" name="address" /></div>

                                <div class="form-group">
                                    <label class="control-label">Country</label>

                                    <select id="country" name="country_id" class="form-control" required >
                                        <option selected="true" value="{{ $data['user']->country_id}}">Select Country
                                        </option>
                                        @foreach($data['countries'] as  $country)
                                            <option value="{{$country->id}}">
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">State</label>
                                    <select name="state_id" id="state" class="form-control" required >
                                        <option value="{{ $data['user']->state_id}}">Choose Country first</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <select name="city_id" id="city" class="form-control" required>
                                        <option value="{{ $data['user']->city_id}}">Choose State first</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mobile Number</label>
                                    <input class="form-control placeholder-no-fix" required
                                           value="{{ $data['user']->user_phone}}" type="text"
                                           placeholder="Mobile Number"  name="user_phone"/></div>
                                <div class="form-group">
                                    <label class="control-label">Landline Number</label>
                                    <input class="form-control placeholder-no-fix" type="text" required
                                           value="{{ $data['user']->landline_no}}" placeholder="Landline Number"
                                            name="landline_no"/></div>
                                <div class="form-group">
                                    <label class="control-label">Skype Number</label>
                                    <input class="form-control placeholder-no-fix" type="text" required
                                           value="{{ $data['user']->skype_no}}" placeholder="Skype Number"
                                           name="skype_no" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Role</label>

                                    <select id="role" name="role_id" class="form-control" required>
                                        <option selected="true" value="{{ $data['user']->role_id}}">Select Role</option>
                                        @foreach($data['roles'] as  $role)
                                            <option value="{{$role->id}}">
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Gender</label>
                                    <input type="radio" name="gender" id="male" value="Male" checked >
                                    <label for="male">Male</label>
                                    <span class="check"></span>

                                    <input type="radio" name="gender" id="female" value="Female">
                                    <label for="female">Female</label>
                                    <span class="check"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Profile Image</label>
                                    <input type="file" class="form-control form-control-line" name="profile_image" required
                                           value="{{ $data['user']->profile_image}}" >
                                </div>

                                <div class="margiv-top-10">

                                    <button type="submit" class="btn green">{{ __(' Save Changes ') }}</button>

                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://www.codermen.com/js/jquery.js"></script>

    <script type="text/javascript">
        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-state-list')}}?country_id=" + countryID,
                    success: function (res) {
                        if (res) {
                            $("#state").empty();
                            $("#state").append('<option>Select</option>');
                            $.each(res, function (id, name) {
                                $("#state").append('<option value="' + id + '">' + name + '</option>');
                            });

                        } else {
                            $("#state").empty();
                        }
                    }
                });
            } else {
                $("#state").empty();
                $("#city").empty();
            }
        });
        $('#state').on('change', function () {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-city-list')}}?state_id=" + stateID,
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $.each(res, function (id, name) {
                                $("#city").append('<option value="' + id + '">' + name + '</option>');
                            });

                        } else {
                            $("#city").empty();
                        }
                    }
                });
            } else {
                $("#city").empty();
            }

        });
    </script>

@endsection