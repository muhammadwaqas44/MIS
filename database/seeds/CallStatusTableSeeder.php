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
            ],
            [
                'id' => 2,
                'name' => 'Not Connected',
                'parent_id' => null,
            ],
            [
                'id' => 3,
                'name' => 'Interview Schedule',
                'parent_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Not Interedted',
                'parent_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Interested But Not Available',
                'parent_id' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Fellow Up',
                'parent_id' => 1,
            ],
            [
                'id' => 7,
                'name' => 'Change Date',
                'parent_id' => 1,
            ],
            [
                'id' => 8,
                'name' => 'Not Response',
                'parent_id' => 2,
            ],
            [
                'id' => 9,
                'name' => 'Mobile Off',
                'parent_id' => 2,
            ],

        ];

        foreach ($statuses as $status) {
            \App\CallStatus::create([
                'id' => $status['id'],
                'name' => $status['name'],
                'parent_id' =>$status['parent_id'],
            ]);
        }
    }
}
