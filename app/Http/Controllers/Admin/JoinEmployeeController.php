<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Department;
use App\Designation;
use App\EmpHistory;
use App\Employee;
use App\EmployeeOfficialDoc;
use App\EmployeePersonalDoc;
use App\JobApplication;
use App\LocationOffice;
use App\Services\JoinEmployeeServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JoinEmployeeController extends Controller
{
    public function allEmployees(Request $request, JoinEmployeeServices $employeeServices)
    {
        $data['allEmployees'] = $employeeServices->allEmployees($request);
        return view('admin.employment.all-employees', compact('data'));
    }

    public function addEmployee()
    {
        $data['countries'] = Country::all();
        $data['department'] = Department::orderBy('name')->where('id', '!=', 1)->get();
        $data['location'] = LocationOffice::orderBy('name')->where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        return view('admin.employment.add-employee', compact('data'));
    }

    public function joinEmployee($jobApplicantId)
    {
        $data['jobApplicant'] = EmpHistory::find($jobApplicantId);
        $data['countries'] = Country::all();
        $data['location'] = LocationOffice::orderBy('name')->where('id', '!=', 1)->get();
        $data['department'] = Department::orderBy('name')->where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        return view('admin.employment.join-employee', compact('data'));
    }

    public function postJoinEmployee(Request $request, JoinEmployeeServices $employeeServices)
    {
        $employeeServices->postJoinEmployee($request);
        return redirect()->route('admin.all-employees');
    }

    public function updateEmployeeView($employeeId)
    {
        $data['countries'] = Country::all();
        $data['department'] = Department::orderBy('name')->where('id', '!=', 1)->get();
        $data['location'] = LocationOffice::orderBy('name')->where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        $employee = Employee::find($employeeId);
        return view('admin.employment.update-employee', compact('employee', 'data'));
    }

    public function updateEmployee(Request $request, $employeeId, JoinEmployeeServices $employeeServices)
    {
        $employeeServices->updateEmployee($request, $employeeId);
        return redirect()->route('admin.all-employees');
    }

    public function downloadResumeEmployee($employeeId)
    {
        $employee = EmployeePersonalDoc::where('employee_id', $employeeId)->firstOrFail();
        if ($employee->resume) {
            $file = public_path() . $employee->resume;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadIDProofEmployee($employeeId)
    {
        $employee = EmployeePersonalDoc::where('employee_id', $employeeId)->firstOrFail();
        if ($employee->id_proof) {
            $file = public_path() . $employee->id_proof;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }


    public function downloadOtherDocPersonalEmployee($employeeId)
    {
        $employee = EmployeePersonalDoc::where('employee_id', $employeeId)->firstOrFail();
        if ($employee->other_doc_personal) {
            $file = public_path() . $employee->other_doc_personal;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadOfficialLatterEmployee($employeeId)
    {
        $employee = EmployeeOfficialDoc::where('employee_id', $employeeId)->firstOrFail();
        if ($employee->official_latter) {
            $file = public_path() . $employee->official_latter;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadJoiningLatterEmployee($employeeId)
    {
        $employee = EmployeeOfficialDoc::where('employee_id', $employeeId)->firstOrFail();
        if ($employee->joining_latter) {
            $file = public_path() . $employee->joining_latter;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadContractPaperEmployee($employeeId)
    {
        $employee = EmployeeOfficialDoc::where('employee_id', $employeeId)->firstOrFail();
        if ($employee->contract_paper) {
            $file = public_path() . $employee->contract_paper;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadOtherDocOfficialEmployee($employeeId)
    {
        $employee = EmployeeOfficialDoc::where('employee_id', $employeeId)->firstOrFail();
        if ($employee->other_doc_official) {
            $file = public_path() . $employee->other_doc_official;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }
}
