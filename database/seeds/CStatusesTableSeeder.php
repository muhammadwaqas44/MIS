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
                'module' => 'processPlan',
            ],
            [
                'id' => 7,
                'name' => 'In Process',
                'module' => 'updatePlat',
            ],
            [
                'id' => 8,
                'name' => 'Processed',
                'module' => 'updatePlat',
            ],
            [
                'id' => 9,
                'name' => 'Rectification In Process',
                'module' => 'rectificationPlat',
            ], [
                'id' => 10,
                'name' => 'Rectified',
                'module' => 'rectificationPlat',
            ],
            [
                'id' => 11,
                'name' => 'Reviewed',
                'module' => 'reviewPlan',
            ],
            [
                'id' => 12,
                'name' => 'Rectification Required',
                'module' => 'reviewRectificationPlan',
            ],
            [
                'id' => 13,
                'name' => 'Published',
                'module' => 'publishPlan',
            ],
            [
                'id' => 14,
                'name' => 'Published For Published Module',
                'module' => 'publishedPlan',
            ],
            [
                'id' => 15,
                'name' => 'Standard License',
                'module' => 'youtube_license',
            ],
            [
                'id' => 16,
                'name' => 'Creative Common',
                'module' => 'youtube_license',
            ],

            [
                'id' => 17,
                'name' => 'Public',
                'module' => 'youtube_view',
            ],
            [
                'id' => 18,
                'name' => 'Unlisted',
                'module' => 'youtube_view',
            ],
            [
                'id' => 19,
                'name' => 'Private',
                'module' => 'youtube_view',
            ],
            [
                'id' => 20,
                'name' => 'Public',
                'module' => 'facebook_view',
            ],
            [
                'id' => 21,
                'name' => 'Friends',
                'module' => 'facebook_view',
            ],
            [
                'id' => 22,
                'name' => 'Only Me',
                'module' => 'facebook_view',
            ],
            [
                'id' => 23,
                'name' => 'Added Youtube Content',
                'module' => 'youtube',
            ],
            [
                'id' => 24,
                'name' => 'Produce Youtube Content',
                'module' => 'youtube',
            ],
            [
                'id' => 25,
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
