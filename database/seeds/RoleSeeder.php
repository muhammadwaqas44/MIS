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
        $roles = ['Admin', 'Employee','Guest','Tawk.to User'];

        foreach ($roles as $role) {
            App\Role::create(['name' => $role]);
        }
    }
}
