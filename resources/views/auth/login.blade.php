<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>User Login </title>
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
<!-- BEGIN LOGO -->
{{--<div class="logo">--}}
{{--<a href="index.html">--}}
{{--<img src="../assets/pages/img/logo-big-white.png" style="height: 17px;" alt=""/> </a>--}}
{{--</div>--}}
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="POST" action="{{route('login-user')}}">

        @csrf
        <input type="hidden" name="timezone" id="timezone">

        <div class="form-title">
            <span class="form-title">Welcome.</span>
            <span class="form-subtitle">Please login.</span>
        </div>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        <div class="form-group">

            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix @error('email') is-invalid @enderror"
                   name="email" id="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email"/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input type="password"
                   class="form-control form-control-solid placeholder-no-fix @error('password') is-invalid @enderror"
                   name="password" id="password"
                   required autocomplete="current-password"/>
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-actions">
            <button type="button" class="btn red btn-block uppercase loginFormBtn">Login</button>
        </div>
        <div class="form-actions">
            <div class="pull-left">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}/> Remember me
                    <span></span>
                </label>
            </div>

        </div>

        <div class="create-account">
            <p>
                <a href="{{route('register2')}}" class="btn-primary btn" id="register-btn">Create an account</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
<div class="copyright hide"> 2014 © Metronic. Admin Dashboard Template.</div>

<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets-admin/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets-admin/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets-admin/assets/pages/scripts/login.min.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets-admin/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/moment-timezone-with-data.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.loginFormBtn').on('click', function (e) {
            e.preventDefault();
            var timezoneaa = moment.tz.guess();
            var tz = $('#timezone').val('' + timezoneaa);
            var time = $('#timezone').val();
            if(time){
                $(".login-form").submit();
            }
        });
    });
</script>
</body>

</html>