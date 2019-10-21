<?php

namespace App\Exports;

use App\EmpHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShortlistedExport implements FromCollection, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $allJobApplicants = collect(EmpHistory::where([['is_active', 1], ['call_id', 10]])->get());
        $valueArray = [];
        foreach ($allJobApplicants as $jobApplicant) {
            if (!isset($jobApplicant->status->name)) {
                $status = null;
            } else {
                $status = $jobApplicant->status->name;
            }
            $valueArray[] = [
                'id' => $jobApplicant->applicant->id,
                'name' => $jobApplicant->applicant->name,
                'email' => $jobApplicant->applicant->email,
                'user_phone' => $jobApplicant->applicant->user_phone,
                'designation_id' => $jobApplicant->applicant->designation->name,
                'dateTime' => $jobApplicant->dateTime,
                'status' => $status,
                'remarks' => $jobApplicant->remarks,
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
            'Position',
            'Date & Time',
            'Status',
            'Remarks',
            'Updated At',
        ];
    }
}
