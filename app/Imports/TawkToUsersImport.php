<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TawkToUsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $skipRows = $rows->slice(1);
//        dd($skipRows);
        foreach ($skipRows as $row) {

            if (!isset($row[0])) {
                return null;
            }
            if (!isset($row[1])) {
                return null;
            }
            if (!isset($row[2])) {
                return null;
            }
            if (!isset($row[3])) {
                return null;
            }
            if ($row[2]) {
                $email = $row[2];
                $emailCheck = User::where('email', $email)->first();
                if (!$emailCheck) {
                    User::create([
                        'first_name' => $row[0],
                        'last_name' => $row[1],
                        'email' => $row[2],
                        'user_phone' => $row[3],
                        'role_id' => 3,
                    ]);
                }
            }

        }
    }
}
