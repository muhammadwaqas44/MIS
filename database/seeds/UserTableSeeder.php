<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [

            [
                "email" => "admin@gmail.com",
                "password" => bcrypt("12345"),
                "first_name" => "Muhammad",
                "last_name" => "Waqas",
                "user_phone" => "03123769495",
                "is_active" => 1,
                "role_id" => 1,
                "gender" => 'Male',
                "address" => "F1 Block Johar Town",
            ],

        ];
        foreach ($users as $user) {

            \App\User::create([
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'user_phone' => $user['user_phone'],
                'is_active' => $user['is_active'],
                'role_id' => $user['role_id'],
                'gender' => $user['gender'],
                'address' => $user['address'],
            ]);



        }
    }
}
