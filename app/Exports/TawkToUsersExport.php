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
        $roleId = [3, 5];
        $allUsers = collect(User::withoutGlobalScopes()->whereIn('role_id', $roleId)->whereNull('deleted_at')->get());
        $valueArray = [];
        foreach ($allUsers as $user) {
            $valueArray[] = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'user_phone' => $user->user_phone,
            ];
        }
        return collect([
            $valueArray
        ]);
    }
    public function headings(): array
    {
        return [

            'First Name',
            'Last Name',
            'Email',
            'User Phone',
       
        ];
    }
}