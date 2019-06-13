<?php

use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = ['Rozee'];

        foreach ($designations as $designation) {
            \App\Designation::create(['name' => $designation]);
        }
    }
}
