<?php

use Illuminate\Database\Seeder;

class EmployeeReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = ['None','Probation','Performance Review'];

        foreach ($reviews as $review) {
            \App\EmployeeReview::create(['name' => $review]);
        }
    }
}
