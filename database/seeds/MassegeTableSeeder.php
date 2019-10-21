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
                'title' => '2:30pm',
                'body' => '$name,%0aOur this week show topic is "Become a Pro at YouTube Marketing"%0aRemember, our show timing is 8pm on every Friday.%0aSee you,%0aDanKash',
            ],
            [
                'title' => '6:30pm',
                'body' => '$name,%0aHappy Friday!%0a%0aWe will be live at 8pm. Here’s your chance to talk to me LIVE and amazing giveaways.%0aTopic: "Creating Effective Facebook Ad"%0aSee you,%0aDanKash',
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
