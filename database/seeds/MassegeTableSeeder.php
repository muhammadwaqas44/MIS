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
                'title' => 'Show Live Freelancing',
                'body' => '$name,%0aRemember we did a survey on The Ask Dankash show timings?%0aIt is Every Friday 8-9 pm.%0aThis week’s topic: Freelancing for Newbies%0aSee you,%0aDania',
            ],[
                'title' => 'Show Live 2',
                'body' => '$name,%0aHappy Friday!%0a%0aWe will be live at 8pm. Here’s your chance to talk to me LIVE and amazing giveaways.%0aTopic: Freelancing for Newbies.%0aSee you,%0aDania'
            ],[
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
