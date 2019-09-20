<?php

use Illuminate\Database\Seeder;

class ExpCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'name' => 'Fund',
                'exp_type_id' => 1,
            ],
            [
                'name' => 'Value',
                'exp_type_id' => 1,
            ],
            [
                'name' => 'Cash',
                'exp_type_id' => 1,
            ],
            [
                'name' => 'Expense',
                'exp_type_id' => 2,
            ], [
                'name' => 'Cash Online',
                'exp_type_id' => 2,
            ],
        ];

        foreach ($reviews as $review) {
            \App\ExpCategory::create([
                'name' => $review['name'],
                'exp_type_id' => $review['exp_type_id'],
            ]);
        }
    }
}
