@extends('admin-layout.app')
@section('title', "Create Expense")
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Expenses
                <i class="fa fa-circle"></i>
            </li>
            <li>
                All Expenses
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Create Expense
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
                        <span class="caption-subject bold uppercase">Add Expense</span>
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
                                <form id="form"
                                        action="{{route('admin.post-expense-add')}}"
                                        method="post"
                                        enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Expense Type</label><span
                                                        style="color:red;">*</span>
                                                <select class="form-control" name="exp_type_id" required id="type">
                                                    <option value="">Select Type</option>
                                                    @foreach($data['type'] as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Expense Category</label><span
                                                        style="color:red;">*</span>
                                                <select class="form-control" name="expCategory_id" required
                                                        id="ExpCategory">
                                                    <option value="">First Select Type</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Amount</label><span
                                                        style="color:red;">*</span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="amount" placeholder="Specification"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Date</label><span style="color:red;">*</span>
                                            <div class="input-append date form_datetime1">
                                                <input size="16" type="text" autocomplete="off" required
                                                       name="date" placeholder="Date"
                                                       class="form-control">
                                                <span class="add-on"><i
                                                            class="icon-remove"></i></span>
                                                <span class="add-on"><i
                                                            class="icon-th"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>By Employee</label><span style="color:red;">*</span>
                                            <select class="form-control" name="employee_id" required>
                                                <option value="{{auth()->user()->id}}">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</option>
                                                @foreach($data['employees'] as $user)
                                                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>File</label>
                                            <input type="file" class="form-control" name="image"
                                                   placeholder="Choise File">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <textarea type="text" rows="3" name="description"
                                                          placeholder="Description"
                                                          class="form-control"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="margiv-top-10">

                                        <button type="submit"
                                                class="btn green">Save
                                        </button>
                                        <a href="{{route('admin.all-expenses')}}">
                                            <button type="button"
                                                    class="btn red">
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

        var ThisMonth = new Date().getMonth() + 1;
        var ThisDay = new Date().getDate();
        var ThisYear = new Date().getFullYear();
        var ThisDate = ThisMonth.toString() + "/" + ThisDay.toString() + "/" + ThisYear.toString();
        var date = $('#form').find('input[name="date"]').val(ThisDate);
        $(document).ready(date);
    </script>
    <script type="text/javascript">

        $('#type').change(function () {
            var id = $(this).val();

            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('category-list')}}?exp_type_id=" + id,
                    success: function (res) {
                        if (res) {
                            console.log(res);
                            $("#ExpCategory").empty();
                            $("#ExpCategory").append('<option>Select</option>');
                            $.each(res, function (id, name) {
                                $("#ExpCategory").append('<option value="' + id + '">' + name + '</option>');
                            });
                        } else {
                            $("#ExpCategory").empty();
                        }
                    }
                });
            } else {
                $("#ExpCategory").empty();
            }
        });
    </script>
@endsection