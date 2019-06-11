<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class TawkToUsersImport implements ToModel
{
    public function model(array $row)
    {
        if (isset($row[0])) {
            $name = $row[0];
            $splitName = explode(' ', $name);
            $first_name = $splitName[0];
            $last_name = !empty($splitName[1]) ? $splitName[1] : '';
            if (!isset($splitName[1])) {
                $last_name = null;
            }
        } else {
            $first_name = null;
            $last_name = null;
        }
        if (isset($row[1])) {
            $email = $row[1];
            $emailCheck = User::where('email', $email)->first();
            if (!$emailCheck) {
                return new User([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $row[1],
                    'user_phone' => $row[2],
                    'role_id' => 4,
                ]);
            }
        }
    }
}
