<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $allemployees = collect(Employee::where('is_active', 1)->get());
        $valueArray = [];
        foreach ($allemployees as $employee) {
            if (isset($employee->nationalityCountry->name)) {
                $nationality = $employee->nationalityCountry->name;
            } else {
                $nationality = null;
            }
            if (isset($employee->currentCountry->name)) {
                $currentCountry = $employee->currentCountry->name;
            } else {
                $currentCountry = null;
            }
            if (isset($employee->currentState->name)) {
                $currentState = $employee->currentState->name;
            } else {
                $currentState = null;
            }
            if (isset($employee->currentCity->name)) {
                $currentCity = $employee->currentCity->name;
            } else {
                $currentCity = null;
            }
            if (isset($employee->permanentCountry->name)) {
                $permanentCountry = $employee->permanentCountry->name;
            } else {
                $permanentCountry = null;
            }
            if (isset($employee->permanentState->name)) {
                $permanentState = $employee->permanentState->name;
            } else {
                $permanentState = null;
            }
            if (isset($employee->permanentCity->name)) {
                $permanentCity = $employee->permanentCity->name;
            } else {
                $permanentCity = null;
            }
            if (isset($employee->departmentName->name)) {
                $departmentName = $employee->departmentName->name;
            } else {
                $departmentName = null;
            }
            if (isset($employee->designationName->name)) {
                $designationName = $employee->designationName->name;
            } else {
                $designationName = null;
            }
            if (isset($employee->locationName->name)) {
                $locationName = $employee->locationName->name;
            } else {
                $locationName = null;
            }
            if ($employee->checkList->count() > 0) {
                $check = $employee->checkList->where('is_active', 1)->first();
//                dd($check);
                if (isset($check->emp_form)) {
                    if ($check->emp_form == 1) {
                        $emp_form = 'Submitted';
                    } else {
                        $emp_form = 'Not Submit';
                    }
                } else {
                    $emp_form = 'Not Submit';
                }
                if (isset($check->emp_cnic)) {
                    if ($check->emp_cnic == 1) {
                        $emp_cnic = 'Submitted';
                    } else {
                        $emp_cnic = 'Not Submit';
                    }
                } else {
                    $emp_cnic = 'Not Submit';
                }
                if (isset($check->emp_photos)) {
                    if ($check->emp_photos == 1) {
                        $emp_photos = 'Submitted';
                    } else {
                        $emp_photos = 'Not Submit';
                    }
                } else {
                    $emp_photos = 'Not Submit';
                }
                if (isset($check->emp_educational_original)) {
                    if ($check->emp_educational_original == 1) {
                        $emp_educationalOr = 'Submitted';
                    } else {
                        $emp_educationalOr = 'Not Submit';
                    }
                } else {
                    $emp_educationalOr = 'Not Submit';
                }
                if (isset($check->emp_educational_copy)) {
                    if ($check->emp_educational_copy == 1) {
                        $emp_educational_copy = 'Submitted';
                    } else {
                        $emp_educational_copy = 'Not Submit';
                    }
                } else {
                    $emp_educational_copy = 'Not Submit';
                }
                if (isset($check->emp_original_deg)) {
                    if ($check->emp_original_deg == 1) {
                        $emp_original_deg = 'Submitted';
                    } else {
                        $emp_original_deg = 'Not Submit';
                    }
                } else {
                    $emp_original_deg = 'Not Submit';
                }
                if (isset($check->emp_nda)) {
                    if ($check->emp_nda == 1) {
                        $emp_nda = 'Submitted';
                    } else {
                        $emp_nda = 'Not Submit';
                    }
                } else {
                    $emp_nda = 'Not Submit';
                }
                if (isset($check->emp_agreement)) {
                    if ($check->emp_agreement == 1) {
                        $emp_agreement = 'Submitted';
                    } else {
                        $emp_agreement = 'Not Submit';
                    }
                } else {
                    $emp_agreement = 'Not Submit';
                }
                if (isset($check->emp_biometric)) {
                    if ($check->emp_biometric == 1) {
                        $emp_biometric = 'Submitted';
                    } else {
                        $emp_biometric = 'Not Submit';
                    }
                } else {
                    $emp_biometric = 'Not Submit';
                }
                if (isset($check->emp_office_policies)) {
                    if ($check->emp_office_policies == 1) {
                        $emp_office_policies = 'Submitted';
                    } else {
                        $emp_office_policies = 'Not Submit';
                    }
                } else {
                    $emp_office_policies = 'Not Submit';
                }
            } else {
                $emp_form = 'Not Submit';
                $emp_cnic = 'Not Submit';
                $emp_photos = 'Not Submit';
                $emp_educationalOr = 'Not Submit';
                $emp_educational_copy = 'Not Submit';
                $emp_original_deg = 'Not Submit';
                $emp_nda = 'Not Submit';
                $emp_agreement = 'Not Submit';
                $emp_biometric = 'Not Submit';
                $emp_office_policies = 'Not Submit';
            }
            if (isset($employee->user->first_name)) {
                $first_name = $employee->user->first_name;
            } else {
                $first_name = null;
            }
            if (isset($employee->user->last_name)) {
                $last_name = $employee->user->last_name;
            } else {
                $last_name = null;
            }

            $valueArray[] = [
                'id' => $employee->id,
                "first_name" => $employee->first_name,
                "last_name" => $employee->last_name,
                'probation_due_on' => $employee->probation_due_on,
                'remarks' => $employee->remarks,
                "date_of_birth" => $employee->date_of_birth,
                "gender" => $employee->gender,
                "marital_status" => $employee->marital_status,
                "father_name" => $employee->father_name,
                "nationality" => $nationality,
                "n_identity_type" => $employee->n_identity_type,
                "n_identity_no" => $employee->n_identity_no,
                "current_address" => $employee->current_address,
                "current_city" => $currentCity,
                "current_state" => $currentState,
                "current_country" => $currentCountry,
                "permanent_address" => $employee->permanent_address,
                "permanent_city" => $permanentCity,
                "permanent_state" => $permanentState,
                "permanent_country" => $permanentCountry,
                "mobile_number" => $employee->mobile_number,
                "secondary_number" => $employee->secondary_number,
                "skype_id" => $employee->skype_id,
                "email" => $employee->email,
                "bank_name" => $employee->bank_name,
                "branch_name" => $employee->branch_name,
                "account_name" => $employee->account_name,
                "account_no" => $employee->account_no,
                "department_id" => $departmentName,
                "designation_id" => $designationName,
                "location_id" => $locationName,
                "joining_date" => $employee->joining_date,
                "created_at" => $employee->created_at,
                'created_first_name' => $first_name,
                'created_last_name' => $last_name,
                'emp_form' => $emp_form,
                'emp_cnic' => $emp_cnic,
                'emp_photos' => $emp_photos,
                'emp_educational_original' => $emp_educationalOr,
                'emp_educational_copy' => $emp_educational_copy,
                'emp_original_deg' => $emp_original_deg,
                'emp_nda' => $emp_nda,
                'emp_agreement' => $emp_agreement,
                'emp_biometric' => $emp_biometric,
                'emp_office_policies' => $emp_office_policies,
            ];
        }
        return collect([
            $valueArray
        ]);
    }

    public function headings(): array
    {
        return [
            'Id',
            'First Name',
            'Last Name',
            'Review Due On',
            'Remarks',
            'Data Of Birth',
            'Gender',
            'Marital Status',
            'Father Name',
            'Nationality',
            'Nationality Identity Type',
            'Nationality Identity Not Submit',
            'Current Address',
            'Current Country',
            'Current State',
            'Current City',
            'Permanent Address',
            'Permanent Country',
            'Permanent State',
            'Permanent City',
            'Mobile Number',
            'Secondary Number',
            'Skype ID',
            'Email',
            'Bank Name',
            'Branch Name',
            'Account Name',
            'Account Number',
            'Department',
            'Designation',
            'Location',
            'Joining Date',
            'Created At',
            'Created By First Name',
            'Created By Last Name',
            'Employment Form',
            'CNIC copy collected',
            'Photos collected',
            'Educational & Experience Record - Original Seen',
            'Educational & Experience Record - Copy Collected',
            'Latest Original Degree Withheld',
            'NDA Signed',
            'Agreement Signed',
            'Biometric registration',
            'Office Policies Communicated',
        ];
    }
}
