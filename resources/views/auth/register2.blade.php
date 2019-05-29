<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>User Registration</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets-admin/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets-admin/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('assets-admin/assets/pages/css/login-2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
</head>
<!-- END HEAD -->

<body class=" login">


<div class="content">

    <!-- BEGIN REGISTRATION FORM -->
    <form method="post" action="{{ route('registrationPost') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-title">
            <span class="form-title">Sign Up</span>
        </div>
        <p class="hint"> Enter your personal details below: </p>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Fisrt Name" name="first_name"
                   required/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="last_name"/>
        </div>

        <div class="form-group">

            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" required/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                   placeholder="Password" name="password" required/>

        </div>


        <div class="form-actions">
            <a href="{{route('login')}}" class="btn btn-default">Cancel</a>
            {{--<button type="button" id="register-back-btn" class="btn btn-default">Back</button>--}}
            <button type="submit" class="btn red uppercase pull-right">{{ __('Register') }}</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<div class="copyright hide"> 2014 © Metronic. Admin Dashboard Template.</div>
<script src="http://www.codermen.com/js/jquery.js"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets-admin/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/select2/js/select2.full.min.js')}}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets-admin/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets-admin/assets/pages/scripts/login.min.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->


</body>

</html>
