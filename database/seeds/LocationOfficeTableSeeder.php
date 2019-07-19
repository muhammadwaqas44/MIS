<?php

use Illuminate\Database\Seeder;

class LocationOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Locations = ['None', 'Lahore Office', 'USA',];

        foreach ($Locations as $Location) {
            \App\LocationOffice::create(['name' => $Location]);
        }
    }
}
