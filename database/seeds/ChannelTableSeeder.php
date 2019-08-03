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
        $channels = ['None','Rozee.PK', 'Linkedin','Facebook','Email','WalkIn','Reference','Job Portal'];

        foreach ($channels as $channel) {
            \App\Channel::create(['name' => $channel]);
        }
    }
}
