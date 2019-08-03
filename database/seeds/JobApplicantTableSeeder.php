<?php

use Illuminate\Database\Seeder;

class JobApplicantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicants= [

            [
                'id'=>1,
                "email" => "NA12345@gmail.com",
                "name" => "NA",
                "user_phone" => "NA",
                "city_name" => "NA",
                "address" => "NA",
                "skype_id" => "NA",
                "expected_salary" => "NA",
                "designation_id" => 1,
                "channel_id" => 1,
                "experience_id" => 1,
                "resume" => null,
                "is_active" => 0,

            ],

        ];
        foreach ($applicants as $applicant) {

           \App\JobApplication::create([
                'id' => $applicant['id'],
                'name' => $applicant['name'],
                'email' => $applicant['email'],
                'user_phone' => $applicant['user_phone'],
                'city_name' => $applicant['city_name'],
                'address' => $applicant['address'],
                'skype_id' => $applicant['skype_id'],
                'expected_salary' => $applicant['expected_salary'],
                'designation_id' => $applicant['designation_id'],
                'channel_id' => $applicant['channel_id'],
                'experience_id' => $applicant['experience_id'],
                'resume' => $applicant['resume'],
                'is_active' => $applicant['is_active'],
            ]);



        }
    }
}
