<?php

use Illuminate\Database\Seeder;

class ExpTypeSeeder extends Seeder
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
                'name' => 'Expense',
                'cash_way' => 'credit',
            ],
            [
                'name' => 'Funds',
                'cash_way' => 'debit',
            ],
            [
                'name' => 'Music Expense',
                'cash_way' => 'credit',
            ],
        ];

        foreach ($reviews as $review) {
            \App\ExpType::create([
                'name' => $review['name'],
                'cash_way' => $review['cash_way'],
            ]);
        }
    }
}
