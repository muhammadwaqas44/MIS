<?php

use Illuminate\Database\Seeder;

class ContactTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types= ['Video','Text','Audio'];

        foreach ($types as $type) {
            \App\ContentType::create(['name' => $type]);
        }
    }
}
