@extends('admin-layout.app')
@section('title', "Add Employee Status")
@section('content')


    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Employee Check List</span>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="preview" src="{{asset($employee->profile_image)}}" width="170px"
                                             height="170px">
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Name : {{$employee->first_name}}{{$employee->last_name}}</h5>
                                        <h5>Email : {{$employee->email}}</h5>
                                        <h5>Mobile Number : {{$employee->mobile_number}}</h5>
                                        <h5>Current Address : {{$employee->current_address}}</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Location
                                            : @if(isset($employee->locationName->name)){{$employee->locationName->name}}@endif</h5>
                                        <h5>Department
                                            : @if(isset($employee->departmentName->name)){{$employee->departmentName->name}}@endif</h5>
                                        <h5>Designation
                                            : @if(isset($employee->designationName->name)){{$employee->designationName->name}}@endif</h5>
                                        <h5>Joining Date : {{$employee->joining_date}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="checklist"
                                      action="{{route('admin.post-employment-check-list-page',$employee->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$employee->job_id}}" name="job_id">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck1"
                                                           @if(isset($data['updated']->emp_form))@if($data['updated']->emp_form==1)checked
                                                           @endif @endif
                                                           name="emp_form"
                                                           class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck1">Employment
                                                        Form</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="form_date" placeholder="Date"
                                                               @if(isset($data['updated']->form_date))value="{{$data['updated']->form_date}}"
                                                               @endif
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1" name="form_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->form_remarks)){{$data['updated']->form_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck2"
                                                           @if(isset($data['updated']->emp_cnic))@if($data['updated']->emp_cnic==1)checked
                                                           @endif @endif
                                                           name="emp_cnic"
                                                           class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck2">CNIC copy
                                                        collected</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="cnic_date" placeholder="Date"
                                                               @if(isset($data['updated']->cnic_date))value="{{$data['updated']->cnic_date}}"
                                                               @endif
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1" name="cnic_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->cnic_remarks)){{$data['updated']->cnic_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck3"
                                                           @if(isset($data['updated']->emp_photos))@if($data['updated']->emp_photos==1)checked
                                                           @endif @endif
                                                           name="emp_photos" class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck3">Photos
                                                        collected</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="photo_date" placeholder="Date"
                                                               @if(isset($data['updated']->photo_date))value="{{$data['updated']->photo_date}}"
                                                               @endif
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1" name="photo_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->photo_remarks)){{$data['updated']->photo_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck4"
                                                           @if(isset($data['updated']->emp_educational_original))@if($data['updated']->emp_educational_original==1)checked
                                                           @endif @endif
                                                           name="emp_educational_original" class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck4">Educational
                                                        &
                                                        Experience Record - Original Seen</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               @if(isset($data['updated']->educational_original_date))value="{{$data['updated']->educational_original_date}}"
                                                               @endif
                                                               name="educational_original_date" placeholder="Date"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1"
                                                                                name="educational_original_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->educational_original_remarks)){{$data['updated']->educational_original_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck5"
                                                           @if(isset($data['updated']->emp_educational_copy))@if($data['updated']->emp_educational_copy==1)checked
                                                           @endif @endif
                                                           name="emp_educational_copy" class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck5">Educational
                                                        &
                                                        Experience Record - Copy Collected</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               @if(isset($data['updated']->educational_copy_date))value="{{$data['updated']->educational_copy_date}}"
                                                               @endif
                                                               name="educational_copy_date" placeholder="Date"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1"
                                                                                name="educational_copy_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->educational_copy_remarks)){{$data['updated']->educational_copy_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck6"
                                                           @if(isset($data['updated']->emp_original_deg))@if($data['updated']->emp_original_deg==1)checked
                                                           @endif @endif
                                                           name="emp_original_deg" class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck6">Latest
                                                        Original
                                                        Degree Withheld</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               @if(isset($data['updated']->original_deg_date))value="{{$data['updated']->original_deg_date}}"
                                                               @endif
                                                               name="original_deg_date" placeholder="Date"
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1" name="original_deg_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->original_deg_remarks)){{$data['updated']->original_deg_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck7"
                                                           @if(isset($data['updated']->emp_nda))@if($data['updated']->emp_office_policies==1)checked
                                                           @endif @endif
                                                           name="emp_nda"
                                                           class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck7">NDA
                                                        Signed</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="nda_date" placeholder="Date"
                                                               @if(isset($data['updated']->nda_date))value="{{$data['updated']->nda_date}}"
                                                               @endif
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1" name="nda_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->nda_remarks)){{$data['updated']->nda_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck8"
                                                           @if(isset($data['updated']->emp_agreement))@if($data['updated']->emp_agreement==1)checked
                                                           @endif @endif
                                                           name="emp_agreement" class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck8">Agreement
                                                        Signed</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="agreement_date" placeholder="Date"
                                                               @if(isset($data['updated']->agreement_date))value="{{$data['updated']->agreement_date}}"
                                                               @endif
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1" name="agreement_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->agreement_remarks)){{$data['updated']->agreement_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck9"
                                                           @if(isset($data['updated']->emp_biometric))@if($data['updated']->emp_biometric==1)checked
                                                           @endif @endif
                                                           name="emp_biometric" class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck9">Biometric
                                                        registration</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="biometric_date" placeholder="Date"
                                                               @if(isset($data['updated']->biometric_date))value="{{$data['updated']->biometric_date}}"
                                                               @endif
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1" name="biometric_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->biometric_remarks)){{$data['updated']->biometric_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="checkbox" value="1" id="defaultCheck10"
                                                           @if(isset($data['updated']->emp_office_policies))@if($data['updated']->emp_office_policies==1)checked
                                                           @endif @endif
                                                           name="emp_office_policies" class="form-check-input">
                                                    <label class="form-check-label" for="defaultCheck10">Office
                                                        Policies
                                                        Communicated</label>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-append date form_datetime1">
                                                        <input size="16" type="text" autocomplete="off"
                                                               name="office_policies_date" placeholder="Date"
                                                               @if(isset($data['updated']->office_policies_date))value="{{$data['updated']->office_policies_date}}"
                                                               @endif
                                                               class="form-control">
                                                        <span class="add-on"><i
                                                                    class="icon-remove"></i></span>
                                                        <span class="add-on"><i
                                                                    class="icon-th"></i></span></div>
                                                </div>
                                                <div class="col-md-4"><textarea type="text" class="form-control"
                                                                                rows="1"
                                                                                name="office_policies_remarks"
                                                                                placeholder="Remarks">@if(isset($data['updated']->office_policies_remarks)){{$data['updated']->office_policies_remarks}} @endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button TYPE="submit" class="btn green-dark">Save</button>
                                            <a href="{{route('admin.all-employment-check-list')}}">
                                                <button type="button" class="btn btn-outline-info">Cancel</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="sample_1">
                            <thead>
                            <tr>
                                <th> Id</th>
                                <th> Employment Form</th>
                                <th> Employment Form Date</th>
                                <th> Employment Form Remarks</th>
                                <th> CNIC copy collected</th>
                                <th> CNIC copy collected Date</th>
                                <th> CNIC copy collected Remarks</th>
                                <th> Photos collected</th>
                                <th> Photos collected Date</th>
                                <th> Photos collected Remarks</th>
                                <th> Educational & Experience Record - Original Seen</th>
                                <th> Educational & Experience Record - Original Seen Date</th>
                                <th> Educational & Experience Record - Original Seen Remarks</th>
                                <th> Educational & Experience Record - Copy Collected</th>
                                <th> Educational & Experience Record - Copy Collected Date</th>
                                <th> Educational & Experience Record - Copy Collected Remarks</th>
                                <th> Latest Original Degree Withheld</th>
                                <th> Latest Original Degree Withheld Date</th>
                                <th> Latest Original Degree Withheld Remarks</th>
                                <th> NDA Signed</th>
                                <th> NDA Signed Date</th>
                                <th> NDA Signed Remarks</th>
                                <th> Agreement Signed</th>
                                <th> Agreement Signed Date</th>
                                <th> Agreement Signed Remarks</th>
                                <th> Biometric registration</th>
                                <th> Biometric registration Date</th>
                                <th> Biometric registration Remarks</th>
                                <th> Office Policies Communicated</th>
                                <th> Office Policies Communicated Date</th>
                                <th> Office Policies Communicated Remarks</th>
                                <th>Created By</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['checkListsEmploye']  as $employee)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$employee->id}} </td>
                                    <td>  @if(isset($employee->emp_form))@if($employee->emp_form==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->form_date}}</td>
                                    <td class="center">{{$employee->form_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_cnic))@if($employee->emp_cnic==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->cnic_date}}</td>
                                    <td class="center">{{$employee->cnic_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_photos))@if($employee->emp_photos==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->photo_date}}</td>
                                    <td class="center">{{$employee->photo_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_educational_original))@if($employee->emp_educational_original==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->educational_original_date}}</td>
                                    <td class="center">{{$employee->educational_original_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_educational_copy))@if($employee->emp_educational_copy==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->educational_copy_date}}</td>
                                    <td class="center">{{$employee->educational_copy_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_original_deg))@if($employee->emp_original_deg==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->original_deg_date}}</td>
                                    <td class="center">{{$employee->original_deg_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_nda))@if($employee->emp_nda==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->nda_date}}</td>
                                    <td class="center">{{$employee->nda_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_agreement))@if($employee->emp_agreement==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->agreement_date}}</td>
                                    <td class="center">{{$employee->agreement_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_biometric))@if($employee->emp_biometric==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->biometric_date}}</td>
                                    <td class="center">{{$employee->biometric_remarks}}</td>
                                    <td class="center">@if(isset($employee->emp_office_policies))@if($employee->emp_office_policies==1)
                                            Submit @endif @endif</td>
                                    <td class="center">{{$employee->office_policies_date}}</td>
                                    <td class="center">{{$employee->office_policies_remarks}}</td>
                                    <td class="center">{{$employee->user->first_name}}{{$employee->user->last_name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets-admin/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets-admin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <script src="{{asset('assets-admin/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets-admin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script type="text/javascript">
        $(".form_datetime1").datepicker({
            format: "mm/dd/yyyy",
            showMeridian: false,
            autoclose: true,
            todayBtn: "linked"
        });

        $(document).ready(function () {
            $("#defaultCheck1").click(function () {
                var Emp_form = $('#defaultCheck1').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="form_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="form_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck2").click(function () {
                var Emp_form = $('#defaultCheck2').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="cnic_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="cnic_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck3").click(function () {
                var Emp_form = $('#defaultCheck3').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="photo_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="photo_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck4").click(function () {
                var Emp_form = $('#defaultCheck4').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="educational_original_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="educational_original_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck5").click(function () {
                var Emp_form = $('#defaultCheck5').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="educational_copy_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="educational_copy_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck6").click(function () {
                var Emp_form = $('#defaultCheck6').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="original_deg_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="original_deg_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck7").click(function () {
                var Emp_form = $('#defaultCheck7').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="nda_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="nda_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck8").click(function () {
                var Emp_form = $('#defaultCheck8').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="agreement_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="agreement_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck9").click(function () {
                var Emp_form = $('#defaultCheck9').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="biometric_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="biometric_date"]').val("");
                }
            });
        });
        $(document).ready(function () {
            $("#defaultCheck10").click(function () {
                var Emp_form = $('#defaultCheck10').is(":checked");
                if (Emp_form == true) {
                    var ThisMonth = new Date().getMonth() + 1;
                    var ThisDay = new Date().getDate();
                    var ThisYear = new Date().getFullYear();
                    var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
                    $('#checklist').find('input[name="office_policies_date"]').val(ThisDate);
                } else {
                    $('#checklist').find('input[name="office_policies_date"]').val("");
                }
            });
        });

    </script>
@endsection