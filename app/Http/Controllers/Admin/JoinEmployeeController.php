<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\Country;
use App\Department;
use App\Designation;
use App\DocumentsOfficial;
use App\DocumentsPersonal;
use App\EmpHistory;
use App\Employee;
use App\EmployeeHistroy;
use App\EmployeeOfficialDoc;
use App\EmployeeOfficialDocument;
use App\EmployeePersonalDoc;
use App\EmployeePersonalDocument;
use App\EmployeeReview;
use App\Exports\EmployeesExport;
use App\JobApplication;
use App\LocationOffice;
use App\Services\JoinEmployeeServices;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
        $data['employee_reviews'] = EmployeeReview::where('id', '!=', 1)->get();
        $data['department'] = Department::orderBy('name')->where('id', '!=', 1)->get();
        $data['location'] = LocationOffice::orderBy('name')->where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        $data['empHis'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.employment.add-employee', compact('data'));
    }

    public function joinEmployee($jobApplicantId)
    {
        $data['jobApplicant'] = EmpHistory::find($jobApplicantId);
        $data['countries'] = Country::all();
        $data['employee_reviews'] = EmployeeReview::where('id', '!=', 1)->get();
        $data['location'] = LocationOffice::orderBy('name')->where('id', '!=', 1)->get();
        $data['department'] = Department::orderBy('name')->where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        $data['empHis'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.employment.join-employee', compact('data'));
    }

    public function postJoinEmployee(Request $request, JoinEmployeeServices $employeeServices)
    {
//        dd($request->all());
//        ini_set('memory_limit', '2M');
        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '2M');
        ini_set('memory_limit', $normalMemoryLimit);
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'location_id' => 'required',
            'profile_image' => 'max:2000',
            'resume' => 'max:2000',
            'id_proof' => 'max:2000',
            'other_doc_personal' => 'max:2000',
            'official_latter' => 'max:2000',
            'joining_latter' => 'max:2000',
            'contract_paper' => 'max:2000',
            'other_doc_official' => 'max:2000',
        ], [
            'profile_image' => 'You have to choose the file. The Max size of Image is 2000kb!',
            'resume' => 'The Max size of Resume is 2000kb!',
            'id_proof' => 'The Max size of ID Proof is 2000kb!',
            'other_doc_personal' => 'The Max size of Other Doc Personal is 2000kb!',
            'official_latter' => 'The Max size of Official Latter is 2000kb!',
            'joining_latter' => 'The Max size of Joining Latter is 2000kb!',
            'contract_paper' => 'The Max size of Contract Paper is 2000kb!',
            'other_doc_official' => 'The Max size of Other Doc Official is 2000kb!',
        ]);
        $employeeServices->postJoinEmployee($request);
        return redirect()->route('admin.all-employees');
    }

    public function addEmployeePost(Request $request, JoinEmployeeServices $employeeServices)
    {
//        dd($request->all());
//        ini_set('memory_limit', '2M');
        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '2M');
        ini_set('memory_limit', $normalMemoryLimit);
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'location_id' => 'required',
            'profile_image' => 'max:2000',
            'resume' => 'max:2000',
            'id_proof' => 'max:2000',
            'other_doc_personal' => 'max:2000',
            'official_latter' => 'max:2000',
            'joining_latter' => 'max:2000',
            'contract_paper' => 'max:2000',
            'other_doc_official' => 'max:2000',
        ], [
            'profile_image' => 'You have to choose the file. The Max size of Image is 2000kb!',
            'resume' => 'The Max size of Resume is 2000kb!',
            'id_proof' => 'The Max size of ID Proof is 2000kb!',
            'other_doc_personal' => 'The Max size of Other Doc Personal is 2000kb!',
            'official_latter' => 'The Max size of Official Latter is 2000kb!',
            'joining_latter' => 'The Max size of Joining Latter is 2000kb!',
            'contract_paper' => 'The Max size of Contract Paper is 2000kb!',
            'other_doc_official' => 'The Max size of Other Doc Official is 2000kb!',
        ]);
        $employeeServices->addEmployeePost($request);
        return redirect()->route('admin.all-employees');
    }

    public function updateEmployeeView($employeeId)
    {
        $data['countries'] = Country::all();
        $data['employee_reviews'] = EmployeeReview::where('id', '!=', 1)->get();
        $data['department'] = Department::orderBy('name')->where('id', '!=', 1)->get();
        $data['location'] = LocationOffice::orderBy('name')->where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        $data['empHis'] = EmpHistory::orderBy('id', 'desc')->get();
        $employee = Employee::withoutGlobalScopes()->find($employeeId);
        return view('admin.employment.update-employee', compact('employee', 'data'));
    }

    public function statusEmployeeView($employeeId)
    {
        $data['callStatus'] = CallStatus::where('module', '=', 'EmploymentStatus')->get();
        $data['empHis'] = EmpHistory::orderBy('id', 'desc')->get();
//        dd( $data['empHis']);
        $employee = Employee::withoutGlobalScopes()->find($employeeId);
        return view('admin.employment.status-add', compact('employee', 'data'));
    }

    public function statusEmployeeReview($employeeId)
    {
        $data['callStatus'] = CallStatus::where('module', '=', 'Review')->get();
        $data['empHis'] = EmpHistory::orderBy('id', 'desc')->get();
        $employee = Employee::withoutGlobalScopes()->find($employeeId);
        return view('admin.employment.upcoming-review.add-status-review', compact('employee', 'data'));
    }

    public function addStatusEmployee(Request $request, JoinEmployeeServices $employeeServices)
    {
        $employeeServices->addStatusEmployee($request);
        return redirect()->back();
//            ->route('admin.all-employees');
    }

    public function addStatusEmployeeReview(Request $request, $employeeId, JoinEmployeeServices $employeeServices)
    {
        $employeeServices->addStatusEmployeeReview($request, $employeeId);
        return redirect()->back();
//            ->route('admin.all-upcoming-reviews-employment');
    }

    public function nextReviewEmployeeView($employeeId)
    {
        $data['callStatus'] = CallStatus::where('module', '=', 'NextReview')->get();
        $data['empHis'] = EmpHistory::orderBy('id', 'desc')->get();
        $employee = Employee::withoutGlobalScopes()->find($employeeId);
        return view('admin.employment.upcoming-review.next-review-employee', compact('employee', 'data'));

    }

    public function nextReviewEmployee(Request $request, JoinEmployeeServices $employeeServices)
    {
        $employeeServices->nextReviewEmployee($request);
        return redirect()->back();
//            ->route('admin.all-employees');
    }

    public function nextReviewUpcomingEmployee(Request $request, JoinEmployeeServices $employeeServices)
    {
        $employeeServices->nextReviewEmployee($request);
        return redirect()->back();
//            ->route('admin.all-upcoming-reviews-employment');
    }

    public function updateEmployee(Request $request, $employeeId, JoinEmployeeServices $employeeServices)
    {
        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '2M');
        ini_set('memory_limit', $normalMemoryLimit);
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'location_id' => 'required',
            'profile_image' => 'max:2000',
            'resume' => 'max:2000',
            'id_proof' => 'max:2000',
            'other_doc_personal' => 'max:2000',
            'official_latter' => 'max:2000',
            'joining_latter' => 'max:2000',
            'contract_paper' => 'max:2000',
            'other_doc_official' => 'max:2000',
        ], [
            'profile_image' => 'You have to choose the file. The Max size of Image is 2000kb!',
            'resume' => 'The Max size of Resume is 2000kb!',
            'id_proof' => 'The Max size of ID Proof is 2000kb!',
            'other_doc_personal' => 'The Max size of Other Doc Personal is 2000kb!',
            'official_latter' => 'The Max size of Official Latter is 2000kb!',
            'joining_latter' => 'The Max size of Joining Latter is 2000kb!',
            'contract_paper' => 'The Max size of Contract Paper is 2000kb!',
            'other_doc_official' => 'The Max size of Other Doc Official is 2000kb!',
        ]);
        $employeeServices->updateEmployee($request, $employeeId);
        return redirect()->route('admin.all-employees');
    }

    public function downloadResumeEmployee($employeeId)
    {
        $employee = EmployeePersonalDocument::find($employeeId)->firstOrFail();
        if ($employee->path) {
            $file = public_path() . $employee->path;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadIDProofEmployee($employeeId)
    {
        $employee = EmployeePersonalDocument::find($employeeId)->firstOrFail();
        if ($employee->path) {
            $file = public_path() . $employee->path;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadOtherDocPersonalEmployee($employeeId)
    {
        $employee = EmployeePersonalDocument::where('id', $employeeId)->firstOrFail();
        if ($employee->path) {
            $file = public_path() . $employee->path;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadOfficialLatterEmployee($employeeId)
    {
        $employee = EmployeeOfficialDocument::find($employeeId)->firstOrFail();
        if ($employee->path) {
            $file = public_path() . $employee->path;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadJoiningLatterEmployee($employeeId)
    {
        $employee = EmployeeOfficialDocument::find($employeeId)->firstOrFail();
        if ($employee->path) {
            $file = public_path() . $employee->path;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadContractPaperEmployee($employeeId)
    {
        $employee = EmployeeOfficialDocument::find($employeeId)->firstOrFail();
        if ($employee->path) {
            $file = public_path() . $employee->path;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function downloadOtherDocOfficialEmployee($employeeId)
    {
        $employee = EmployeeOfficialDocument::find($employeeId)->firstOrFail();
        if ($employee->path) {
            $file = public_path() . $employee->path;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function allUpcomingReviews(Request $request, JoinEmployeeServices $employeeServices)
    {
        $data['allEmployees'] = $employeeServices->allUpcomingReviews($request);
        return view('admin.employment.upcoming-review.all-upcoming-reviews', compact('data'));
    }

    public function allActiveInActiveEmployees(Request $request, JoinEmployeeServices $employeeServices)
    {
        $data['allEmployees'] = $employeeServices->allActiveInActiveEmployees($request);
        return view('admin.employment.all-employee-active-inActive', compact('data'));
    }

    public function changeEmployeeStatus($employeeId)
    {
//        dd($employeeId);
        $employee = Employee::find($employeeId);
        if ($employee->is_active == 0) {
            $employee->is_active = 1;
            $employee->save();
        } else {
            $employee->is_active = 0;
            $employee->save();
        }
    }


    public function exportEmployees()
    {
        return Excel::download(new EmployeesExport, 'All-Employees.xlsx');
    }

//    public function createUsers()
//    {
//        $employees = JobApplication::withoutGlobalScopes()->get();
////        dd($employees);
//        foreach ($employees as $employee) {
//            $user = User::withoutGlobalScopes()->where('email', $employee->email)->first();
//            if (!$user) {
//                User::create([
//                    'is_active' => 1,
//                    'role_id' => 5,
//                    "first_name" => $employee->name,
//                    "email" => $employee->email,
//                    "user_phone" => $employee->user_phone,
//                    'password' => Hash::make('12345'),
//                ]);
//            }
//        }
//        return redirect()->back();
//    }
}
