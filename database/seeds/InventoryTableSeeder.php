<?php

use Illuminate\Database\Seeder;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types= ['Mouse','KeyBoard','Laptop'];

        foreach ($types as $type) {
            \App\InventoryType::create(['name' => $type]);
        }
    }
}
