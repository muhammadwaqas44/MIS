<?php

use Illuminate\Database\Seeder;

class PrizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prizes= ['T Shirt', 'Cash', 'Mug', ];

        foreach ($prizes as $prize) {
            \App\Prize::create(['name' => $prize]);
        }
    }
}
