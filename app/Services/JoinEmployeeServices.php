<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 7/11/2019
 * Time: 8:11 PM
 */

namespace App\Services;


use App\EmpHistory;
use App\Employee;
use App\EmployeeHistroy;
use App\EmployeeOfficialDoc;
use App\EmployeePersonalDoc;
use App\Helpers\ImageHelpers;
use Carbon\Carbon;

class JoinEmployeeServices
{
    function __construct()
    {
        $this->allEmployeesPagination = 20;
    }

    public function allEmployees($request)
    {
        $allEmployees = Employee::orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allEmployees = $allEmployees->where('first_name', 'like', '%' . $title . '%')
                ->orWhere('last_name', 'like', '%' . $title . '%')
                ->orWhere('father_name', 'like', '%' . $title . '%')
                ->orWhere('email', 'like', '%' . $title . '%')
                ->orWhere('n_identity_no', 'like', '%' . $title . '%')
                ->orWhere('mobile_number', 'like', '%' . $title . '%')
                ->orWhere('secondary_number', 'like', '%' . $title . '%')
                ->orWhere('skype_id', 'like', '%' . $title . '%');

        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allEmployees = $allEmployees->whereBetween('dateTime', [$start, $end]);

        }
        $data['allEmployees'] = $allEmployees->paginate($this->allEmployeesPagination);
        return $data;
    }

    public function postJoinEmployee($request)
    {
//        dd($request->all());
        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            $profile_image = "/project-assets/images/users/" . $fileName;
        } else {
            $profile_image = null;
        }
        if (!empty($request->resume)) {
            $extension = $request->resume->getClientOriginalExtension();
            $fileName = time() . "-" . 'resume.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
            $resume = "/project-assets/files/" . $fileName;
        } else {
            $resume = $request->resume_hide;
        }
        if (!empty($request->id_proof)) {
            $extension = $request->id_proof->getClientOriginalExtension();
            $fileName = time() . "-" . 'id_proof.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('id_proof'), $fileName);
            $id_proof = "/project-assets/files/" . $fileName;
        } else {
            $id_proof = null;
        }
        if (!empty($request->other_doc_personal)) {
            $extension = $request->other_doc_personal->getClientOriginalExtension();
            $fileName = time() . "-" . 'other_doc_personal.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('other_doc_personal'), $fileName);
            $other_doc_personal = "/project-assets/files/" . $fileName;
        } else {
            $other_doc_personal = null;
        }
        if (!empty($request->official_latter)) {
            $extension = $request->official_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'official_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('official_latter'), $fileName);
            $official_latter = "/project-assets/files/" . $fileName;
        } else {
            $official_latter = null;
        }
        if (!empty($request->joining_latter)) {
            $extension = $request->joining_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'joining_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('joining_latter'), $fileName);
            $joining_latter = "/project-assets/files/" . $fileName;
        } else {
            $joining_latter = null;
        }
        if (!empty($request->contract_paper)) {
            $extension = $request->contract_paper->getClientOriginalExtension();
            $fileName = time() . "-" . 'contract_paper.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('contract_paper'), $fileName);
            $contract_paper = "/project-assets/files/" . $fileName;
        } else {
            $contract_paper = null;
        }
        if (!empty($request->other_doc_official)) {
            $extension = $request->other_doc_official->getClientOriginalExtension();
            $fileName = time() . "-" . 'contract_paper.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('other_doc_official'), $fileName);
            $other_doc_official = "/project-assets/files/" . $fileName;
        } else {
            $other_doc_official = null;
        }
        if (!empty($request->job_id)) {
            $job_id = $request->job_id;
        } else {
            $job_id = null;
        }
        if (!empty($request->empHis_id)) {
            $empHis_id = $request->empHis_id;
        } else {
            $empHis_id = null;
        }
        if (!empty($request->date_of_birth)) {
            $date_of_birth= Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }
        if (!empty($request->joining_date)) {
            $joining_date= Carbon::parse(str_replace('-', '', $request->joining_date))->format('Y-m-d');
        } else {
            $joining_date = null;
        }

        if (!empty($request->empHis_id)) {
            $empHis = EmpHistory::find($request->empHis_id);
            if ($empHis->is_active == 1) {
                $empHis->is_active = 0;
                $empHis->save();
            }
            if ($empHis->is_active == 0) {
                EmpHistory::create([
                    'job_id' => $job_id,
                    'call_id' => 16,
                    'is_active' => 1,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
            }
        }
        $employee = Employee::create([
            "job_id" => $job_id,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "date_of_birth" => $date_of_birth,
            "gender" => $request->gender,
            "marital_status" => $request->marital_status,
            "father_name" => $request->father_name,
            "nationality" => $request->nationality,
            "n_identity_type" => $request->n_identity_type,
            "n_identity_no" => $request->n_identity_no,
            "current_address" => $request->current_address,
            "current_city" => $request->current_city,
            "current_state" => $request->current_state,
            "current_country" => $request->current_country,
            "permanent_address" => $request->permanent_address,
            "permanent_city" => $request->permanent_city,
            "permanent_state" => $request->permanent_state,
            "permanent_country" => $request->permanent_country,
            "mobile_number" => $request->mobile_number,
            "secondary_number" => $request->secondary_number,
            "skype_id" => $request->skype_id,
            "email" => $request->email,
            "bank_name" => $request->bank_name,
            "branch_name" => $request->branch_name,
            "account_name" => $request->account_name,
            "account_no" => $request->account_no,
            "department_id" => $request->department_id,
            "designation_id" => $request->designation_id,
            "location_id" => $request->location_id,
            "profile_image" => $profile_image,
            "joining_date" =>$joining_date ,
            'created_at' => Carbon::now()->timezone(session('timezone')),
            'user_id' => auth()->user()->id,
            "is_active" => 1,
        ]);
        if ($employee) {
            $employee_personal_docs = EmployeePersonalDoc::create([
                'employee_id' => $employee->id,
                "resume" => $resume,
                "id_proof" => $id_proof,
                "other_doc_personal" => $other_doc_personal,
                "is_active" => 1,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
            $employee_official_docs = EmployeeOfficialDoc::create([
                'employee_id' => $employee->id,
                "official_latter" => $official_latter,
                "joining_latter" => $joining_latter,
                "contract_paper" => $contract_paper,
                "other_doc_official" => $other_doc_official,
                "is_active" => 1,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
            $employee_histroy = EmployeeHistroy::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "date_of_birth" => $date_of_birth,
                "gender" => $request->gender,
                "marital_status" => $request->marital_status,
                "father_name" => $request->father_name,
                "nationality" => $request->nationality,
                "n_identity_type" => $request->n_identity_type,
                "n_identity_no" => $request->n_identity_no,
                "current_address" => $request->current_address,
                "current_city" => $request->current_city,
                "current_state" => $request->current_state,
                "current_country" => $request->current_country,
                "permanent_address" => $request->permanent_address,
                "permanent_city" => $request->permanent_city,
                "permanent_state" => $request->permanent_state,
                "permanent_country" => $request->permanent_country,
                "mobile_number" => $request->mobile_number,
                "secondary_number" => $request->secondary_number,
                "skype_id" => $request->skype_id,
                "email" => $request->email,
                "bank_name" => $request->bank_name,
                "branch_name" => $request->branch_name,
                "account_name" => $request->account_name,
                "account_no" => $request->account_no,
                "department_id" => $request->department_id,
                "designation_id" => $request->designation_id,
                "location_id" => $request->location_id,
                "profile_image" => $profile_image,
                "joining_date" =>$joining_date,
                'created_at' => Carbon::now()->timezone(session('timezone')),
                "job_id" => $job_id,
                "employee_id" => $employee->id,
                "resume" => $resume,
                "id_proof" => $id_proof,
                "other_doc_personal" => $other_doc_personal,
                "official_latter" => $official_latter,
                "joining_latter" => $joining_latter,
                "contract_paper" => $contract_paper,
                "other_doc_official" => $other_doc_official,
                'user_id' => auth()->user()->id,
                "is_active" => 1,
            ]);
        }
    }

    public function updateEmployee($request, $employeeId)
    {
        $employee = Employee::find($employeeId);
        $employeePersonalDoc = EmployeePersonalDoc::where('employee_id', $employeeId)->first();
        $employeeOfficialDoc = EmployeeOfficialDoc::where('employee_id', $employeeId)->first();
        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            $profile_image = "/project-assets/images/users/" . $fileName;
        } else {
            $profile_image = $request->profile_image_hide;
        }
        if (!empty($request->resume)) {
            $extension = $request->resume->getClientOriginalExtension();
            $fileName = time() . "-" . 'resume.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
            $resume = "/project-assets/files/" . $fileName;
        } else {
            $resume = $request->resume_hide;
        }
        if (!empty($request->id_proof)) {
            $extension = $request->id_proof->getClientOriginalExtension();
            $fileName = time() . "-" . 'id_proof.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('id_proof'), $fileName);
            $id_proof = "/project-assets/files/" . $fileName;
        } else {
            $id_proof = $request->id_proof_hie;
        }
        if (!empty($request->other_doc_personal)) {
            $extension = $request->other_doc_personal->getClientOriginalExtension();
            $fileName = time() . "-" . 'other_doc_personal.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('other_doc_personal'), $fileName);
            $other_doc_personal = "/project-assets/files/" . $fileName;
        } else {
            $other_doc_personal = $request->other_doc_personal_hide;
        }
        if (!empty($request->official_latter)) {
            $extension = $request->official_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'official_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('official_latter'), $fileName);
            $official_latter = "/project-assets/files/" . $fileName;
        } else {
            $official_latter = $request->official_latter_hide;
        }
        if (!empty($request->joining_latter)) {
            $extension = $request->joining_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'joining_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('joining_latter'), $fileName);
            $joining_latter = "/project-assets/files/" . $fileName;
        } else {
            $joining_latter = $request->joining_latter_hide;
        }
        if (!empty($request->contract_paper)) {
            $extension = $request->contract_paper->getClientOriginalExtension();
            $fileName = time() . "-" . 'contract_paper.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('contract_paper'), $fileName);
            $contract_paper = "/project-assets/files/" . $fileName;
        } else {
            $contract_paper = $request->contract_paper_hide;
        }
        if (!empty($request->other_doc_official)) {
            $extension = $request->other_doc_official->getClientOriginalExtension();
            $fileName = time() . "-" . 'contract_paper.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('other_doc_official'), $fileName);
            $other_doc_official = "/project-assets/files/" . $fileName;
        } else {
            $other_doc_official = $request->other_doc_official_hide;
        }
        if (!empty($request->job_id)) {
            $job_id = $request->job_id;
        } else {
            $job_id = null;
        }
        if (!empty($request->date_of_birth)) {
            $date_of_birth= Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }
        if (!empty($request->joining_date)) {
            $joining_date= Carbon::parse(str_replace('-', '', $request->joining_date))->format('Y-m-d');
        } else {
            $joining_date = null;
        }
        $employee->update([
            "job_id" => $job_id,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "date_of_birth" =>$date_of_birth,
            "gender" => $request->gender,
            "marital_status" => $request->marital_status,
            "father_name" => $request->father_name,
            "nationality" => $request->nationality,
            "n_identity_type" => $request->n_identity_type,
            "n_identity_no" => $request->n_identity_no,
            "current_address" => $request->current_address,
            "current_city" => $request->current_city,
            "current_state" => $request->current_state,
            "current_country" => $request->current_country,
            "permanent_address" => $request->permanent_address,
            "permanent_city" => $request->permanent_city,
            "permanent_state" => $request->permanent_state,
            "permanent_country" => $request->permanent_country,
            "mobile_number" => $request->mobile_number,
            "secondary_number" => $request->secondary_number,
            "skype_id" => $request->skype_id,
            "email" => $request->email,
            "bank_name" => $request->bank_name,
            "branch_name" => $request->branch_name,
            "account_name" => $request->account_name,
            "account_no" => $request->account_no,
            "department_id" => $request->department_id,
            "designation_id" => $request->designation_id,
            "location_id" => $request->location_id,
            "profile_image" => $profile_image,
            "joining_date" => $joining_date,
            'created_at' => Carbon::now()->timezone(session('timezone')),
            'user_id' => auth()->user()->id,
            "is_active" => 1,
        ]);

        if ($employee) {
            $employee_personal_docs = $employeePersonalDoc->update([
                'employee_id' => $employee->id,
                "resume" => $resume,
                "id_proof" => $id_proof,
                "other_doc_personal" => $other_doc_personal,
                "is_active" => 1,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
            $employee_official_docs = $employeeOfficialDoc->update([
                'employee_id' => $employee->id,
                "official_latter" => $official_latter,
                "joining_latter" => $joining_latter,
                "contract_paper" => $contract_paper,
                "other_doc_official" => $other_doc_official,
                "is_active" => 1,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
            $employee_histroy = EmployeeHistroy::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "date_of_birth" => $date_of_birth,
                "gender" => $request->gender,
                "marital_status" => $request->marital_status,
                "father_name" => $request->father_name,
                "nationality" => $request->nationality,
                "n_identity_type" => $request->n_identity_type,
                "n_identity_no" => $request->n_identity_no,
                "current_address" => $request->current_address,
                "current_city" => $request->current_city,
                "current_state" => $request->current_state,
                "current_country" => $request->current_country,
                "permanent_address" => $request->permanent_address,
                "permanent_city" => $request->permanent_city,
                "permanent_state" => $request->permanent_state,
                "permanent_country" => $request->permanent_country,
                "mobile_number" => $request->mobile_number,
                "secondary_number" => $request->secondary_number,
                "skype_id" => $request->skype_id,
                "email" => $request->email,
                "bank_name" => $request->bank_name,
                "branch_name" => $request->branch_name,
                "account_name" => $request->account_name,
                "account_no" => $request->account_no,
                "department_id" => $request->department_id,
                "designation_id" => $request->designation_id,
                "location_id" => $request->location_id,
                "profile_image" => $profile_image,
                "joining_date" => $joining_date,
                'created_at' => Carbon::now()->timezone(session('timezone')),
                "job_id" => $job_id,
                "employee_id" => $employee->id,
                "resume" => $resume,
                "id_proof" => $id_proof,
                "other_doc_personal" => $other_doc_personal,
                "official_latter" => $official_latter,
                "joining_latter" => $joining_latter,
                "contract_paper" => $contract_paper,
                "other_doc_official" => $other_doc_official,
                'user_id' => auth()->user()->id,
                "is_active" => 1,
            ]);
        }
    }
}