<?php

use Illuminate\Database\Seeder;

class InvetStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types= ['Added','Assign'];

        foreach ($types as $type) {
            \App\InventoryStatus::create(['name' => $type]);
        }
    }
}
