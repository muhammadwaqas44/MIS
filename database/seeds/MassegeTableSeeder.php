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
                'title' => '17/7/2019',
                'body' => '$name,%0aOur this week show topic is "Become a Pro at YouTube Marketing"%0aRemember, our show timing is 8pm on every Friday.%0aSee you,%0aDania and Kashif',
            ],
            [
                'title' => 'Show Live Freelancing',
                'body' => '$name,%0aRemember we did a survey on The Ask Dankash show timings?%0aIt is Every Friday 8-9 pm.%0aThis week’s topic: Freelancing for Newbies%0aSee you,%0aDania',
            ],[
                'title' => '19/07/2019',
                'body' => '$name,%0aHappy Friday!%0a%0aWe will be live at 8pm. Here’s your chance to talk to me LIVE and amazing giveaways.%0aTopic: "Become a Pro at YouTube Marketing"%0aSee you,%0aDania'
            ],[
                'title' => 'Show Live',
                'body' => 'Dear $name, The Show is going to live on $date . Do not miss it',
            ],
            [
                'title' => 'Live Stream',
                'body' => '$name,%0aOur Tomorrow show topic is "Creating Effecitve Facebook Ad"%0aRemember, our show timing is 8pm on every Friday.%0aSee you,%0aDania and Kash',
            ],
            [
                'title' => '12/7/2019',
                'body' => '$name,%0aHappy Friday!%0a%0aWe will be live at 8pm. Here’s your chance to talk to me LIVE and amazing giveaways.%0aTopic: "Creating Effective Facebook Ad"%0aSee you,%0aDania',
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
