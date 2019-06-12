<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TawkToUsersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $allUsers = collect(User::withoutGlobalScopes()->where('role_id', '=', 3)->get());
        $valueArray = [];
        foreach ($allUsers as $user) {
            $valueArray[] = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'user_phone' => $user->user_phone,
                'gender' => $user->gender,
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
            'Email',
            'User Phone',
            'Gender',
        ];
    }

}