<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 8/3/2019
 * Time: 8:06 PM
 */

namespace App\Services;


use App\Employee;
use App\EmploymentCheckList;
use Carbon\Carbon;

class EmploymentCheckServices
{
    function __construct()
    {
        $this->allSchedulesPagination = 20;
    }

    public function allEmploymentCheck($request)
    {
        $allEmploymentCheck = Employee::orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allEmploymentCheck = $allEmploymentCheck->where('first_name', 'like', '%' . $title . '%')
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
            $allEmploymentCheck = $allEmploymentCheck->whereBetween('created_at', [$start, $end]);
        }
        $data['allEmploymentCheck'] = $allEmploymentCheck->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function postEmploymentCheck($request, $employeeId)
    {
        $checkData = EmploymentCheckList::where([['employee_id', $employeeId], ['is_active', 1]])->first();

        if (!empty($request->form_date)) {
            $form_date = Carbon::parse(str_replace('-', '', $request->form_date))->format('Y-m-d');
        } else {
            $form_date = null;
        }
        if (!empty($request->cnic_date)) {
            $cnic_date = Carbon::parse(str_replace('-', '', $request->cnic_date))->format('Y-m-d');
        } else {
            $cnic_date = null;
        }
        if (!empty($request->photo_date)) {
            $photo_date = Carbon::parse(str_replace('-', '', $request->photo_date))->format('Y-m-d');
        } else {
            $photo_date = null;
        }
        if (!empty($request->educational_original_date)) {
            $educational_original_date = Carbon::parse(str_replace('-', '', $request->educational_original_date))->format('Y-m-d');
        } else {
            $educational_original_date = null;
        }
        if (!empty($request->educational_copy_date)) {
            $educational_copy_date = Carbon::parse(str_replace('-', '', $request->educational_copy_date))->format('Y-m-d');
        } else {
            $educational_copy_date = null;
        }
        if (!empty($request->original_deg_date)) {
            $original_deg_date = Carbon::parse(str_replace('-', '', $request->original_deg_date))->format('Y-m-d');
        } else {
            $original_deg_date = null;
        }
        if (!empty($request->nda_date)) {
            $nda_date = Carbon::parse(str_replace('-', '', $request->nda_date))->format('Y-m-d');
        } else {
            $nda_date = null;
        }
        if (!empty($request->agreement_date)) {
            $agreement_date = Carbon::parse(str_replace('-', '', $request->agreement_date))->format('Y-m-d');
        } else {
            $agreement_date = null;
        }
        if (!empty($request->office_policies_date)) {
            $office_policies_date = Carbon::parse(str_replace('-', '', $request->office_policies_date))->format('Y-m-d');
        } else {
            $office_policies_date = null;
        }
        if (!empty($request->biometric_date)) {
            $biometric_date = Carbon::parse(str_replace('-', '', $request->biometric_date))->format('Y-m-d');
        } else {
            $biometric_date = null;
        }


        if (!empty($request->emp_form)) {
            $emp_form = 1;
        } else {
            $emp_form = 0;
        }
        if (!empty($request->emp_cnic)) {
            $emp_cnic = 1;
        } else {
            $emp_cnic = 0;
        }
        if (!empty($request->emp_photos)) {
            $emp_photos = 1;
        } else {
            $emp_photos = 0;
        }
        if (!empty($request->emp_educational_original)) {
            $emp_educational_original = 1;
        } else {
            $emp_educational_original = 0;
        }
        if (!empty($request->emp_educational_copy)) {
            $emp_educational_copy = 1;
        } else {
            $emp_educational_copy = 0;
        }
        if (!empty($request->emp_original_deg)) {
            $emp_original_deg = 1;
        } else {
            $emp_original_deg = 0;
        }
        if (!empty($request->emp_nda)) {
            $emp_nda = 1;
        } else {
            $emp_nda = 0;
        }
        if (!empty($request->emp_agreement)) {
            $emp_agreement = 1;
        } else {
            $emp_agreement = 0;
        }
        if (!empty($request->emp_biometric)) {
            $emp_biometric = 1;
        } else {
            $emp_biometric = 0;
        }
        if (!empty($request->emp_office_policies)) {
            $emp_office_policies = 1;
        } else {
            $emp_office_policies = 0;
        }


        if ($checkData) {
            if ($checkData->is_active == 1) {
                $checkData->is_active = 0;
                $checkData->save();
            }
            if ($checkData->is_active == 0) {
                EmploymentCheckList::create([
                    "is_active" => "1",
                    "emp_form" => $emp_form,
                    "form_date" => $form_date,
                    "form_remarks" => $request->form_remarks,
                    "emp_cnic" => $emp_cnic,
                    "cnic_date" => $cnic_date,
                    "cnic_remarks" => $request->cnic_remarks,
                    "emp_photos" => $emp_photos,
                    "photo_date" => $photo_date,
                    "photo_remarks" => $request->photo_remarks,
                    "emp_educational_original" => $emp_educational_original,
                    "educational_original_date" => $educational_original_date,
                    "educational_original_remarks" => $request->educational_original_remarks,
                    "emp_educational_copy" => $emp_educational_copy,
                    "educational_copy_date" => $educational_copy_date,
                    "educational_copy_remarks" => $request->educational_copy_remarks,
                    "emp_original_deg" => $emp_original_deg,
                    "original_deg_date" => $original_deg_date,
                    "original_deg_remarks" => $request->original_deg_remarks,
                    "emp_nda" => $emp_nda,
                    "nda_date" => $nda_date,
                    "nda_remarks" => $request->nda_remarks,
                    "emp_agreement" => $emp_agreement,
                    "agreement_date" => $agreement_date,
                    "agreement_remarks" => $request->agreement_remarks,
                    "emp_biometric" => $emp_biometric,
                    "biometric_date" => $biometric_date,
                    "biometric_remarks" => $request->biometric_remarks,
                    "emp_office_policies" => $emp_office_policies,
                    "office_policies_date" => $office_policies_date,
                    "office_policies_remarks" => $request->office_policies_remarks,
                    "employee_id" => $employeeId,
                    "user_id" => auth()->user()->id,

                ]);
            }
        } else {
            EmploymentCheckList::create([
                "is_active" => "1",
                "emp_form" => $emp_form,
                "form_date" => $form_date,
                "form_remarks" => $request->form_remarks,
                "emp_cnic" => $emp_cnic,
                "cnic_date" => $cnic_date,
                "cnic_remarks" => $request->cnic_remarks,
                "emp_photos" => $emp_photos,
                "photo_date" => $photo_date,
                "photo_remarks" => $request->photo_remarks,
                "emp_educational_original" => $emp_educational_original,
                "educational_original_date" => $educational_original_date,
                "educational_original_remarks" => $request->educational_original_remarks,
                "emp_educational_copy" => $emp_educational_copy,
                "educational_copy_date" => $educational_copy_date,
                "educational_copy_remarks" => $request->educational_copy_remarks,
                "emp_original_deg" => $emp_original_deg,
                "original_deg_date" => $original_deg_date,
                "original_deg_remarks" => $request->original_deg_remarks,
                "emp_nda" => $emp_nda,
                "nda_date" => $nda_date,
                "nda_remarks" => $request->nda_remarks,
                "emp_agreement" => $emp_agreement,
                "agreement_date" => $agreement_date,
                "agreement_remarks" => $request->agreement_remarks,
                "emp_biometric" => $emp_biometric,
                "biometric_date" => $biometric_date,
                "biometric_remarks" => $request->biometric_remarks,
                "emp_office_policies" => $emp_office_policies,
                "office_policies_date" => $office_policies_date,
                "office_policies_remarks" => $request->office_policies_remarks,
                "employee_id" => $employeeId,
                "user_id" => auth()->user()->id,

            ]);
        }
    }
}