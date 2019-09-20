<?php

namespace App\Exports;

use App\Winner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WinnerExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $allWinners = collect(Winner::all());
        $valueArray = [];
        foreach ($allWinners as $winner) {
            if ($winner->is_active == 1) {
                $active = 'Active';
            }

            if (isset($winner->user)) {
                $email = $winner->user->email;
            } else {
                $email = 'None';
            }
            if (isset($winner->statusName)) {
                $status = $winner->statusName->name;
            } else {
                $status = 'None';
            }
            $valueArray[] = [
                'id' => $winner->id,
                'first_name' => $winner->first_name,
                'last_name' => $winner->last_name,
                'user_phone' => $winner->user_phone,
                'email' => $email,
                'cnic' => $winner->cnic,
                'account' => $winner->account,
                'prize' => $winner->prizeName->name,
                'social_link' => $winner->social_link,
                'status' => $status,
                'question' => $winner->question,
                'address' => $winner->address,
                'winning_date' => $winner->winning_date,
                'created_first_name' => $winner->createdByName->first_name,
                'created_last_name' => $winner->createdByName->last_name,
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
            'User Phone',
            'Email',
            'CNIC',
            'Account',
            'Prize',
            'Social Link',
            'Status',
            'Remarks',
            'Winning Date',
            'Created By First Name',
            'Created By Last Name',

        ];
    }
}
