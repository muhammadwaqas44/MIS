@extends('admin-layout.app')
@section('title', "Produce Content")
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
                Add Status
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
                        <span class="caption-subject bold uppercase">Add Status</span>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Type : </label>
                                            {{$inventory->typeName->name}}

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Specification
                                                : </label> {{$inventory->specification}}

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Note :</label>
                                            <textarea type="text" rows="2" name="remarks"
                                                      placeholder="Remarks" style="border: none; background: none"
                                                      readonly
                                                      class="form-control">{{$inventory->note}}</textarea>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <hr>
                            <div class="col-md-12">
                                <form id="myForm" action="{{route('admin.assign-inventory-post')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="inventory_id" value="{{$inventory->id}}">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label class="control-label">Status</label>
                                            <select class="form-control" name="status_id" required id="StatusId">
                                                <option value="">Select Status</option>
                                                @foreach($data['statuses'] as $status)
                                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                            <span id="error2" style="color: red;"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Date</label>
                                            <div class="input-append date form_datetime1">
                                                <input size="16" type="text" autocomplete="off"
                                                       name="on_date" placeholder="Date"
                                                       class="form-control">
                                                <span class="add-on"><i
                                                            class="icon-remove"></i></span>
                                                <span class="add-on"><i
                                                            class="icon-th"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Assign To</label>
                                            <select class="form-control" name="employee_id" id="employeeId">
                                                <option value="">Select Employee</option>
                                                @foreach($data['employees'] as $employee)
                                                    <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <span id="error" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label"> Remarks </label>
                                                <textarea type="text" rows="2" name="remarks"
                                                          placeholder="Remarks"
                                                          class="form-control"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="margiv-top-10">

                                        <button type="button" id="button"
                                                class="btn green"> Save
                                        </button>
                                        <a href="{{route('admin.all-inventories')}}">
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
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover"
                               id="sample_1">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th> Inventory Type</th>
                                <th> Assign To</th>
                                <th> Status</th>
                                <th> Date</th>
                                <th> Remarks</th>
                                <th> Created by</th>
                                <th> Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $data['inventHis']->where('inventory_id',$inventory->id) as $inventHis)
                                <tr class="odd gradeX">
                                    <td class="center"> {{$inventHis->id}} </td>
                                    <td> {{$inventory->typeName->name}}</td>
                                    <td class="center">@if($inventHis->employeeName){{$inventHis->employeeName->first_name}} {{$inventHis->employeeName->last_name}} @endif</td>
                                    <td class="center">{{$inventHis->StatusName->name}}</td>
                                    <td class="center">{{$inventHis->on_date}}</td>
                                    <td class="center">{{$inventHis->remarks}}</td>
                                    <td class="center">{{$inventHis->createdBy->first_name}} {{$inventHis->createdBy->last_name}} </td>
                                    <td class="center">{{$inventHis->created_at}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
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
            format: "dd MM yyyy",
            showMeridian: false,
            autoclose: true,
            todayBtn: true
        });
        $(document).ready(function () {
            $("#button").click(function () {
                var status_id = $(this).parents('#myForm').find('#StatusId').val();
                var employee_id = $(this).parents('#myForm').find('#employeeId').val();
                if (status_id != '') {
                    if (status_id == 2) {
                        if (employee_id == '') {
                            $("#myForm").find('#error').text('Please Select Employee');
                        } else {
                            $("#myForm").submit();
                        }
                    }
                    else {
//                            alert('okokoook');
                        $("#myForm").submit();
                    }
                }else {
                    $("#myForm").find('#error2').text('Please Select Status');
                }
            });
        });
    </script>
@endsection