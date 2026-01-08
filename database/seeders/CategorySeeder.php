<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Residential', 'slug' => 'residential', 'icon' => 'home', 'order' => 1],
            ['name' => 'Commercial', 'slug' => 'commercial', 'icon' => 'business', 'order' => 2],
            ['name' => 'Renovation', 'slug' => 'renovation', 'icon' => 'construction', 'order' => 3],
            ['name' => 'Interior', 'slug' => 'interior', 'icon' => 'chair', 'order' => 4],
            ['name' => 'Landscape', 'slug' => 'landscape', 'icon' => 'park', 'order' => 5],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
