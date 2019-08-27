<?php

use Illuminate\Database\Seeder;

class CStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types= ['Added Plan','Processing','Published'];

        foreach ($types as $type) {
            \App\CStatus::create(['name' => $type]);
        }
    }
}
