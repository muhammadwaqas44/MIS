<?php

namespace App\Exports;

use App\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobApplicantExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $allJobApplicants = collect(JobApplication::all());
        $valueArray = [];
        foreach ($allJobApplicants as $jobApplicant) {
            $valueArray[] = [
                'id' => $jobApplicant->id,
                'name' => $jobApplicant->name,
                'email' => $jobApplicant->email,
                'user_phone' => $jobApplicant->user_phone,
                'address' => $jobApplicant->address,
                'city_name' => $jobApplicant->city_name,
                'skype_id' => $jobApplicant->skype_id,
                'expected_salary' => $jobApplicant->expected_salary,
                'channel_id' => $jobApplicant->channel->name,
                'designation_id' => $jobApplicant->designation->name,
                'experience_id' => $jobApplicant->experience->name,
                'status' => $jobApplicant->history->status->name,
                'remarks' => $jobApplicant->history->remarks,
                'first_name' => $jobApplicant->history->user->first_name,
                'last_name' =>  $jobApplicant->history->user->last_name,
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
