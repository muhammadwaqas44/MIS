<?php

use Illuminate\Database\Seeder;

class CallStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => 1,
                'name' => 'Connected',
                'parent_id' => null,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 2,
                'name' => 'Not Connected',
                'parent_id' => null,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 3,
                'name' => 'Interview Schedule',
                'parent_id' => 1,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 4,
                'name' => 'Not Interedted',
                'parent_id' => 1,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 5,
                'name' => 'Interested But Not Available',
                'parent_id' => 1,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 6,
                'name' => 'Fellow Up',
                'parent_id' => 1,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 7,
                'name' => 'Change Date',
                'parent_id' => 1,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 8,
                'name' => 'Not Response',
                'parent_id' => 2,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 9,
                'name' => 'Mobile Off',
                'parent_id' => 2,
                'module' => 'Call Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 10,
                'name' => 'Shortlisted',
                'parent_id' => null,
                'module' => 'Interview Status',
                'ini_int'=>1,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 11,
                'name' => 'HR Interview Required',
                'parent_id' => null,
                'module' => 'Interview Status',
                'ini_int'=>1,
                'short_int'=>1,
                'tech_int'=>1,
                'hr_int'=>0,
            ],
            [
                'id' => 12,
                'name' => 'Technical Interview Required',
                'parent_id' => null,
                'module' => 'Interview Status',
                'ini_int'=>1,
                'short_int'=>1,
                'tech_int'=>0,
                'hr_int'=>1,
            ],
            [
                'id' => 13,
                'name' => 'Finalized',
                'parent_id' => null,
                'module' => 'Interview Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 14,
                'name' => 'Offer Given',
                'parent_id' => null,
                'module' => 'Interview Status',
                'ini_int'=>1,
                'short_int'=>1,
                'tech_int'=>1,
                'hr_int'=>1,
            ],
            [
                'id' => 15,
                'name' => 'Hired',
                'parent_id' => null,
                'module' => 'Interview Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 16,
                'name' => 'Joined',
                'parent_id' => null,
                'module' => 'Interview Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],
            [
                'id' => 17,
                'name' => 'Initial Interview',
                'parent_id' => null,
                'module' => 'Form Fill Status',
                'ini_int'=>0,
                'short_int'=>0,
                'tech_int'=>0,
                'hr_int'=>0,
            ],


        ];

        foreach ($statuses as $status) {
            \App\CallStatus::create([
                'id' => $status['id'],
                'name' => $status['name'],
                'parent_id' =>$status['parent_id'],
                'module' => $status['module'],
                'ini_int'=>$status['ini_int'],
                'short_int'=>$status['short_int'],
                'tech_int'=>$status['tech_int'],
                'hr_int'=>$status['hr_int'],
            ]);
        }
    }
}
