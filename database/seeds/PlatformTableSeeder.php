<?php

use Illuminate\Database\Seeder;

class PlatformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types= ['Youtube','Facebook','Instagram','Instagram IGTV','Instagram Stories','Instagram Feeds','Twitter','LinkedIn','Pinterest'
        ,'Google Business','Dankash','Blog','Quora','Anchor'];

        foreach ($types as $type) {
            \App\CPlatform::create(['name' => $type]);
        }
    }
}
