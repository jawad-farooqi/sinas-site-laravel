<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\NewsCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'General News',
                'description' => 'General news and updates.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Public Notice',
                'description' => 'Public Notice.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Admission Notice',
                'description' => 'Admission Notice.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Tender Notice',
                'description' => 'Tender Notice.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Jobs',
                'description' => 'Jobs.',
                'sort_order' => 5,
            ],

        ];

        foreach ($categories as $category) {
            NewsCategory::updateOrCreate(
                [
                    'slug' => Str::slug($category['name']),
                ],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => true,
                    'sort_order' => $category['sort_order'],
                ]
            );
        }
    }
}
