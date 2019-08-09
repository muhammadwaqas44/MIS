<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\EmploymentCheckList;
use App\Services\EmploymentCheckServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmploymentCheckController extends Controller
{
    public function allEmploymentCheck(Request $request, EmploymentCheckServices $employmentCheckServices)
    {
        $data['allEmploymentCheck'] = $employmentCheckServices->allEmploymentCheck($request);
        return view('admin.employment.check-list-report.all-emp-check-list', compact('data'));
    }

    public function viewEmploymentCheck($employeeId)
    {
        $data['checkListsEmploye'] = EmploymentCheckList::orderBy('id','desc')->where('employee_id',$employeeId)->get();
        $data['updated'] = EmploymentCheckList::where([['employee_id',$employeeId],['is_active',1]])->first();
//        dd($data['updated']);
        $employee = Employee::find($employeeId);
        return view('admin.employment.check-list-report.add-check-list', compact('employee','data'));
    }

    public function postEmploymentCheck(Request $request,$employeeId, EmploymentCheckServices $employmentCheckServices)
    {
//dd($request->all(),$employeeId);
        $employmentCheckServices->postEmploymentCheck($request,$employeeId);
        return redirect()->back();
    }
}
