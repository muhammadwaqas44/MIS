<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Employee','Guest','Dankash Audience','Job Applicants'];

        foreach ($roles as $role) {
            App\Role::create(['name' => $role]);
        }
    }
}
