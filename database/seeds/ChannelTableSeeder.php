<?php

use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = ['Rozee.PK', 'Linkedin','Facebook','Email','WalkIn','Reference'];

        foreach ($channels as $channel) {
            \App\Channel::create(['name' => $channel]);
        }
    }
}
