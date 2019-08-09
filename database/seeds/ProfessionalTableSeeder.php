<?php

use Illuminate\Database\Seeder;

class ProfessionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionals= ['None','Carpenter','Electrician','Mason','AC Service','Gardening'];

        foreach ($professionals as $professional) {
            \App\Professional::create(['name' => $professional]);
        }
    }
}
