<?php

use Illuminate\Database\Seeder;

class MassegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masseges = [
            [
                'title' => 'Show Live',
                'body' => 'Dear $name, The Show is going to live on $date . Do not miss it',
            ],
            [
                'title' => 'Schedule',
                'body' => 'Dear $name, Your schedule is on $date . Come with you current Resume . Do not miss it',
            ],
            [
                'title' => 'Meeting',
                'body' => 'Dear $name, Your office meeting is on $date . Do not miss it',
            ],
        ];

        foreach ($masseges as $massege) {
          \App\Massege::create([
                'title' => $massege['title'],
                'body' =>$massege['body'],
            ]);
        }
    }
}
