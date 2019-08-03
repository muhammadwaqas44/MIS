<?php

namespace App\Exports;

use App\EmpHistory;
use App\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobApplicantExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $allJobApplicants = collect(EmpHistory::where('is_active',1)->get());
        $valueArray = [];
        foreach ($allJobApplicants as $jobApplicant) {
            if (!isset($jobApplicant->status->name)) {
                $status = null;
            }else{
                $status = $jobApplicant->status->name;
            }
            $valueArray[] = [
                'id' => $jobApplicant->applicant->id,
                'name' => $jobApplicant->applicant->name,
                'email' => $jobApplicant->applicant->email,
                'user_phone' => $jobApplicant->applicant->user_phone,
                'address' => $jobApplicant->applicant->address,
                'city_name' => $jobApplicant->applicant->city_name,
                'skype_id' => $jobApplicant->applicant->skype_id,
                'expected_salary' => $jobApplicant->applicant->expected_salary,
                'channel_id' => $jobApplicant->applicant->channel->name,
                'designation_id' => $jobApplicant->applicant->designation->name,
                'experience_id' => $jobApplicant->applicant->experience->name,
                'status' => $status,
                'remarks' => $jobApplicant->remarks,
                'first_name' => $jobApplicant->user->first_name,
                'last_name' => $jobApplicant->user->last_name,
                'created_at' => $jobApplicant->created_at,
            ];
        }
        return collect([
            $valueArray
        ]);
    }

    public function headings(): array
    {
        return [

            'ID',
            'Name',
            'Email',
            'Phone',
            'Address',
            'City',
            'Skype ID',
            'Expected Salary',
            'Channel',
            'Position',
            'Experience',
            'Status',
            'Remarks',
            'Updated By First Name',
            'Updated By Last Name',
            'Updated At',

        ];
    }
}
