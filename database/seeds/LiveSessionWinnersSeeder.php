<?php

use Illuminate\Database\Seeder;

class LiveSessionWinnersSeeder extends Seeder
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
                'id' => 73,
                'name' => 'Added',
                'parent_id' => null,
                'module' => 'LiveSessionWinners',
                'ini_int' => 0,
                'short_int' => 0,
                'tech_int' => 0,
                'hr_int' => 0,
                'join_emp' => 0,
            ], [
                'id' => 74,
                'name' => 'Dispatched',
                'parent_id' => null,
                'module' => 'LiveSessionWinners',
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
