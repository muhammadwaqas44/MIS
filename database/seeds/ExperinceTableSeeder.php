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
        $experiences = ['None','Fresh', 'Less than 1 Year', '1 Year', '2 Year', '3 Year', '4 Year',
            '5 Year', '6 Year', '7 Year', '8 Year', '9 Year', '10 Year', '11 Year', '12 Year', '13 Year', '14 Year',
            '15 Year', '16 Year', '17 Year', '18 Year', '19 Year', '20 Year', 'More than 20 Years'];

        foreach ($experiences as $experience) {
            \App\Experience::create(['name' => $experience]);
        }
    }
}
