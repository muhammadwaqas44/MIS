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
        $types = [
            [
                'id' => 1,
                'name' => 'Added Idea',
                'module' => 'addIdea',
            ], [
                'id' => 2,
                'name' => 'In Research Process',
                'module' => 'viewIdea',
            ], [
                'id' => 3,
                'name' => 'Ready To Produce',
                'module' => 'viewIdea',
            ], [
                'id' => 4,
                'name' => 'Added Plan',
                'module' => 'addPlan',
            ], [
                'id' => 5,
                'name' => 'In Production',
                'module' => 'viewPlan',
            ],
            [
                'id' => 6,
                'name' => 'Content Produced',
                'module' => 'viewPlan',
            ], [
                'id' => 7,
                'name' => 'In Process',
                'module' => 'updatePlat',
            ], [
                'id' => 8,
                'name' => 'Processed',
                'module' => 'updatePlat',
            ],
            [
                'id' => 9,
                'name' => 'Reviewed',
                'module' => 'reviewPlan',
            ], [
                'id' => 10,
                'name' => 'Published',
                'module' => 'publishPlan',
            ],
            [
                'id' => 11,
                'name' => 'Standard License',
                'module' => 'youtube_license',
            ],
            [
                'id' => 12,
                'name' => 'Creative Common',
                'module' => 'youtube_license',
            ],

            [
                'id' => 13,
                'name' => 'Public',
                'module' => 'youtube_view',
            ],
            [
                'id' => 14,
                'name' => 'Unlisted',
                'module' => 'youtube_view',
            ],
            [
                'id' => 15,
                'name' => 'Private',
                'module' => 'youtube_view',
            ],
            [
                'id' => 16,
                'name' => 'Public',
                'module' => 'facebook_view',
            ],
            [
                'id' => 17,
                'name' => 'Friends',
                'module' => 'facebook_view',
            ],
            [
                'id' => 18,
                'name' => 'Only Me',
                'module' => 'facebook_view',
            ],
            [
                'id' => 19,
                'name' => 'Added Youtube Content',
                'module' => 'youtube',
            ],
            [
                'id' => 20,
                'name' => 'Produce Youtube Content',
                'module' => 'youtube',
            ],
            [
                'id' => 21,
                'name' => 'Publish Youtube Content',
                'module' => 'youtube',
            ],
        ];

        foreach ($types as $type) {
            \App\CStatus::create([
                'id' => $type['id'],
                'name' => $type['name'],
                'module' => $type['module'],
            ]);
        }
    }
}
