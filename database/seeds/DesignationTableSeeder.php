<?php

use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = ['Internee','Frontend Developer','Backend Developer','Web Designer','Video Editor','Graphic Designer'
        ,'SQA Engineer','Manager Sales','SEO Specialist','Director of Operations','General Manager','Office Assistant'
        ,'Office Boy','Guard','Sweeper','Content Creator','WordPress Developer'];

        foreach ($designations as $designation) {
            \App\Designation::create(['name' => $designation]);
        }
    }
}
