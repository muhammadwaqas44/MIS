<?php

use Illuminate\Database\Seeder;

class ReviewAndEmploymentStatusSeeder extends Seeder
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
                'id' => 63,
                'name' => 'Salary Increment Given',
                'parent_id' => null,
                'module' => 'Review',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],
            [
                'id' => 64,
                'name' => 'Promotion',
                'parent_id' => null,
                'module' => 'Review',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],
            [
                'id' => 65,
                'name' => 'Promotion + Salary Increment',
                'parent_id' => null,
                'module' => 'Review',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],
            [
                'id' => 66,
                'name' => 'Unsatisfactory Performance',
                'parent_id' => null,
                'module' => 'Review',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],
            [
                'id' => 67,
                'name' => 'On Board',
                'parent_id' => null,
                'module' => 'EmploymentStatus',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],
            [
                'id' => 68,
                'name' => 'Resigned',
                'parent_id' => null,
                'module' => 'EmploymentStatus',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],
            [
                'id' => 69,
                'name' => 'Terminated',
                'parent_id' => null,
                'module' => 'EmploymentStatus',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],
[
                'id' => 70,
                'name' => 'Left With Out Intimation',
                'parent_id' => null,
                'module' => 'EmploymentStatus',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],[
                'id' => 71,
                'name' => 'Probation',
                'parent_id' => null,
                'module' => 'NextReview',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],[
                'id' => 72,
                'name' => 'Performance',
                'parent_id' => null,
                'module' => 'NextReview',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ],

        ];

        foreach ($statuses as $status) {
            \App\CallStatus::create([
                'id' => $status['id'],
                'name' => $status['name'],
                'parent_id' => $status['parent_id'],
                'module' => $status['module'],
                'ini_int' => $status['ini_int'],
                'short_int' => $status['short_int'],
                'tech_int' => $status['tech_int'],
                'hr_int' => $status['hr_int'],
                'join_emp' => $status['join_emp'],
            ]);
        }
    }
}
