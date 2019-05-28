{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--<div class="row justify-content-center">--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">{{ __('Login') }}</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<form method="POST" action="{{ route('login') }}">--}}
                            {{--@csrf--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="email"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email"--}}
                                           {{--class="form-control @error('email') is-invalid @enderror" name="email"--}}
                                           {{--value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

                                    {{--@error('email')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="password"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password"--}}
                                           {{--class="form-control @error('password') is-invalid @enderror" name="password"--}}
                                           {{--required autocomplete="current-password">--}}

                                    {{--@error('password')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<div class="col-md-6 offset-md-4">--}}
                                    {{--<div class="form-check">--}}
                                        {{--<input class="form-check-input" type="checkbox" name="remember"--}}
                                               {{--id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                        {{--<label class="form-check-label" for="remember">--}}
                                            {{--{{ __('Remember Me') }}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row mb-0">--}}
                                {{--<div class="col-md-8 offset-md-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--{{ __('Login') }}--}}
                                    {{--</button>--}}

                                    {{--@if (Route::has('password.request'))--}}
                                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                            {{--{{ __('Forgot Your Password?') }}--}}
                                        {{--</a>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}




<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Metronic | User Login 2</title>
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
    <link href="{{asset('assers-admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets-admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets-admin/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('assets-admin/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets-admin/assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets-admin/assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet"
          type="text/css" id="style_color"/>
    <link href="{{asset('assets-admin/assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
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
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
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
                   name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email"/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix @error('password') is-invalid @enderror"
                   name="password"
                   required autocomplete="current-password"/>
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn red btn-block uppercase">Login</button>
        </div>
        <div class="form-actions">
            <div class="pull-left">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}/> Remember me
                    <span></span>
                </label>
            </div>
            {{--<div class="pull-right forget-password-block">--}}
                {{--<a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>--}}
            {{--</div>--}}
        </div>
        {{--<div class="login-options">--}}
            {{--<h4 class="pull-left">Or login with</h4>--}}
            {{--<ul class="social-icons pull-right">--}}
                {{--<li>--}}
                    {{--<a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        <div class="create-account">
            <p>
                <a href="javascript:;" class="btn-primary btn" id="register-btn">Create an account</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="index.html" method="post">
        <div class="form-title">
            <span class="form-title">Forget Password ?</span>
            <span class="form-subtitle">Enter your e-mail to reset it.</span>
        </div>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"
                   name="email"/></div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default">Back</button>
            <button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="index.html" method="post">
        <div class="form-title">
            <span class="form-title">Sign Up</span>
        </div>
        <p class="hint"> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname"/></div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"/></div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Address</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address"/></div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">City/Town</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="City/Town" name="city"/></div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Country</label>
            <select name="country" class="form-control">
                <option value="">Country</option>
                <option value="AF">Afghanistan</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AS">American Samoa</option>
                <option value="AD">Andorra</option>
                <option value="AO">Angola</option>
                <option value="AI">Anguilla</option>
                <option value="AR">Argentina</option>
                <option value="AM">Armenia</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="AZ">Azerbaijan</option>
                <option value="BS">Bahamas</option>
                <option value="BH">Bahrain</option>
                <option value="BD">Bangladesh</option>
                <option value="BB">Barbados</option>
                <option value="BY">Belarus</option>
                <option value="BE">Belgium</option>
                <option value="BZ">Belize</option>
                <option value="BJ">Benin</option>
                <option value="BM">Bermuda</option>
                <option value="BT">Bhutan</option>
                <option value="BO">Bolivia</option>
                <option value="BA">Bosnia and Herzegowina</option>
                <option value="BW">Botswana</option>
                <option value="BV">Bouvet Island</option>
                <option value="BR">Brazil</option>
                <option value="IO">British Indian Ocean Territory</option>
                <option value="BN">Brunei Darussalam</option>
                <option value="BG">Bulgaria</option>
                <option value="BF">Burkina Faso</option>
                <option value="BI">Burundi</option>
                <option value="KH">Cambodia</option>
                <option value="CM">Cameroon</option>
                <option value="CA">Canada</option>
                <option value="CV">Cape Verde</option>
                <option value="KY">Cayman Islands</option>
                <option value="CF">Central African Republic</option>
                <option value="TD">Chad</option>
                <option value="CL">Chile</option>
                <option value="CN">China</option>
                <option value="CX">Christmas Island</option>
                <option value="CC">Cocos (Keeling) Islands</option>
                <option value="CO">Colombia</option>
                <option value="KM">Comoros</option>
                <option value="CG">Congo</option>
                <option value="CD">Congo, the Democratic Republic of the</option>
                <option value="CK">Cook Islands</option>
                <option value="CR">Costa Rica</option>
                <option value="CI">Cote d'Ivoire</option>
                <option value="HR">Croatia (Hrvatska)</option>
                <option value="CU">Cuba</option>
                <option value="CY">Cyprus</option>
                <option value="CZ">Czech Republic</option>
                <option value="DK">Denmark</option>
                <option value="DJ">Djibouti</option>
                <option value="DM">Dominica</option>
                <option value="DO">Dominican Republic</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypt</option>
                <option value="SV">El Salvador</option>
                <option value="GQ">Equatorial Guinea</option>
                <option value="ER">Eritrea</option>
                <option value="EE">Estonia</option>
                <option value="ET">Ethiopia</option>
                <option value="FK">Falkland Islands (Malvinas)</option>
                <option value="FO">Faroe Islands</option>
                <option value="FJ">Fiji</option>
                <option value="FI">Finland</option>
                <option value="FR">France</option>
                <option value="GF">French Guiana</option>
                <option value="PF">French Polynesia</option>
                <option value="TF">French Southern Territories</option>
                <option value="GA">Gabon</option>
                <option value="GM">Gambia</option>
                <option value="GE">Georgia</option>
                <option value="DE">Germany</option>
                <option value="GH">Ghana</option>
                <option value="GI">Gibraltar</option>
                <option value="GR">Greece</option>
                <option value="GL">Greenland</option>
                <option value="GD">Grenada</option>
                <option value="GP">Guadeloupe</option>
                <option value="GU">Guam</option>
                <option value="GT">Guatemala</option>
                <option value="GN">Guinea</option>
                <option value="GW">Guinea-Bissau</option>
                <option value="GY">Guyana</option>
                <option value="HT">Haiti</option>
                <option value="HM">Heard and Mc Donald Islands</option>
                <option value="VA">Holy See (Vatican City State)</option>
                <option value="HN">Honduras</option>
                <option value="HK">Hong Kong</option>
                <option value="HU">Hungary</option>
                <option value="IS">Iceland</option>
                <option value="IN">India</option>
                <option value="ID">Indonesia</option>
                <option value="IR">Iran (Islamic Republic of)</option>
                <option value="IQ">Iraq</option>
                <option value="IE">Ireland</option>
                <option value="IL">Israel</option>
                <option value="IT">Italy</option>
                <option value="JM">Jamaica</option>
                <option value="JP">Japan</option>
                <option value="JO">Jordan</option>
                <option value="KZ">Kazakhstan</option>
                <option value="KE">Kenya</option>
                <option value="KI">Kiribati</option>
                <option value="KP">Korea, Democratic People's Republic of</option>
                <option value="KR">Korea, Republic of</option>
                <option value="KW">Kuwait</option>
                <option value="KG">Kyrgyzstan</option>
                <option value="LA">Lao People's Democratic Republic</option>
                <option value="LV">Latvia</option>
                <option value="LB">Lebanon</option>
                <option value="LS">Lesotho</option>
                <option value="LR">Liberia</option>
                <option value="LY">Libyan Arab Jamahiriya</option>
                <option value="LI">Liechtenstein</option>
                <option value="LT">Lithuania</option>
                <option value="LU">Luxembourg</option>
                <option value="MO">Macau</option>
                <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                <option value="MG">Madagascar</option>
                <option value="MW">Malawi</option>
                <option value="MY">Malaysia</option>
                <option value="MV">Maldives</option>
                <option value="ML">Mali</option>
                <option value="MT">Malta</option>
                <option value="MH">Marshall Islands</option>
                <option value="MQ">Martinique</option>
                <option value="MR">Mauritania</option>
                <option value="MU">Mauritius</option>
                <option value="YT">Mayotte</option>
                <option value="MX">Mexico</option>
                <option value="FM">Micronesia, Federated States of</option>
                <option value="MD">Moldova, Republic of</option>
                <option value="MC">Monaco</option>
                <option value="MN">Mongolia</option>
                <option value="MS">Montserrat</option>
                <option value="MA">Morocco</option>
                <option value="MZ">Mozambique</option>
                <option value="MM">Myanmar</option>
                <option value="NA">Namibia</option>
                <option value="NR">Nauru</option>
                <option value="NP">Nepal</option>
                <option value="NL">Netherlands</option>
                <option value="AN">Netherlands Antilles</option>
                <option value="NC">New Caledonia</option>
                <option value="NZ">New Zealand</option>
                <option value="NI">Nicaragua</option>
                <option value="NE">Niger</option>
                <option value="NG">Nigeria</option>
                <option value="NU">Niue</option>
                <option value="NF">Norfolk Island</option>
                <option value="MP">Northern Mariana Islands</option>
                <option value="NO">Norway</option>
                <option value="OM">Oman</option>
                <option value="PK">Pakistan</option>
                <option value="PW">Palau</option>
                <option value="PA">Panama</option>
                <option value="PG">Papua New Guinea</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PH">Philippines</option>
                <option value="PN">Pitcairn</option>
                <option value="PL">Poland</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="QA">Qatar</option>
                <option value="RE">Reunion</option>
                <option value="RO">Romania</option>
                <option value="RU">Russian Federation</option>
                <option value="RW">Rwanda</option>
                <option value="KN">Saint Kitts and Nevis</option>
                <option value="LC">Saint LUCIA</option>
                <option value="VC">Saint Vincent and the Grenadines</option>
                <option value="WS">Samoa</option>
                <option value="SM">San Marino</option>
                <option value="ST">Sao Tome and Principe</option>
                <option value="SA">Saudi Arabia</option>
                <option value="SN">Senegal</option>
                <option value="SC">Seychelles</option>
                <option value="SL">Sierra Leone</option>
                <option value="SG">Singapore</option>
                <option value="SK">Slovakia (Slovak Republic)</option>
                <option value="SI">Slovenia</option>
                <option value="SB">Solomon Islands</option>
                <option value="SO">Somalia</option>
                <option value="ZA">South Africa</option>
                <option value="GS">South Georgia and the South Sandwich Islands</option>
                <option value="ES">Spain</option>
                <option value="LK">Sri Lanka</option>
                <option value="SH">St. Helena</option>
                <option value="PM">St. Pierre and Miquelon</option>
                <option value="SD">Sudan</option>
                <option value="SR">Suriname</option>
                <option value="SJ">Svalbard and Jan Mayen Islands</option>
                <option value="SZ">Swaziland</option>
                <option value="SE">Sweden</option>
                <option value="CH">Switzerland</option>
                <option value="SY">Syrian Arab Republic</option>
                <option value="TW">Taiwan, Province of China</option>
                <option value="TJ">Tajikistan</option>
                <option value="TZ">Tanzania, United Republic of</option>
                <option value="TH">Thailand</option>
                <option value="TG">Togo</option>
                <option value="TK">Tokelau</option>
                <option value="TO">Tonga</option>
                <option value="TT">Trinidad and Tobago</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="TM">Turkmenistan</option>
                <option value="TC">Turks and Caicos Islands</option>
                <option value="TV">Tuvalu</option>
                <option value="UG">Uganda</option>
                <option value="UA">Ukraine</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                <option value="US">United States</option>
                <option value="UM">United States Minor Outlying Islands</option>
                <option value="UY">Uruguay</option>
                <option value="UZ">Uzbekistan</option>
                <option value="VU">Vanuatu</option>
                <option value="VE">Venezuela</option>
                <option value="VN">Viet Nam</option>
                <option value="VG">Virgin Islands (British)</option>
                <option value="VI">Virgin Islands (U.S.)</option>
                <option value="WF">Wallis and Futuna Islands</option>
                <option value="EH">Western Sahara</option>
                <option value="YE">Yemen</option>
                <option value="ZM">Zambia</option>
                <option value="ZW">Zimbabwe</option>
            </select>
        </div>
        <p class="hint"> Enter your account details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username"
                   name="username"/></div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password"
                   placeholder="Password" name="password"/></div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                   placeholder="Re-type Your Password" name="rpassword"/></div>
        <div class="form-group margin-top-20 margin-bottom-20">
            <label class="mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="tnc"/> I agree to the
                <a href="javascript:;">Terms of Service </a> &
                <a href="javascript:;">Privacy Policy </a>
                <span></span>
            </label>
            <div id="register_tnc_error"></div>
        </div>
        <div class="form-actions">
            <button type="button" id="register-back-btn" class="btn btn-default">Back</button>
            <button type="submit" id="register-submit-btn" class="btn red uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<div class="copyright hide"> 2014 © Metronic. Admin Dashboard Template.</div>

<script src="{{asset('assets-admin/assets-admin/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets-admin/assets-admin/assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery.blockui.min.js" type="text/javascript')}}"></script>
<script src="{{asset('assets-admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets-admin/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/counterup/jquery.waypoints.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/counterup/jquery.counterup.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amcharts/amcharts.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amcharts/serial.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amcharts/radar.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amcharts/themes/light.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/amcharts/amstockcharts/amstock.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/fullcalendar/fullcalendar.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/flot/jquery.flot.resize.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/flot/jquery.flot.categories.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets-admin/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets-admin/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets-admin/assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets-admin/assets/layouts/global/scripts/quick-sidebar.min.js')}}"
        type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>