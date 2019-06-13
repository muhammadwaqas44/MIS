<?php

use Illuminate\Database\Seeder;

class ExperinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $experiences = ['Rozee'];

        foreach ($experiences as $experience) {
            \App\Experience::create(['name' => $experience]);
        }
    }
}
