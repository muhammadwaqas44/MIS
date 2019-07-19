<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $departments = ['None', 'Frontend Department', 'Backend Department',  'Designer Department'
            , 'SQA Department', 'SEO Department', 'General Manager',];

        foreach ($departments as $department) {
            \App\Department::create(['name' => $department]);
        }
    }

}
