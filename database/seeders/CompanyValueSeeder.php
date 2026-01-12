<?php

namespace Database\Seeders;

use App\Models\CompanyValue;
use Illuminate\Database\Seeder;

class CompanyValueSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            [
                'icon' => 'verified',
                'title' => 'Quality',
                'description' => 'We never compromise on quality. Every project receives meticulous attention to detail and craftsmanship.',
                'order' => 1,
            ],
            [
                'icon' => 'eco',
                'title' => 'Sustainability',
                'description' => 'Building for tomorrow means respecting today. We prioritize eco-friendly materials and methods.',
                'order' => 2,
            ],
            [
                'icon' => 'lightbulb',
                'title' => 'Innovation',
                'description' => 'We embrace cutting-edge techniques and technologies to deliver modern, efficient structures.',
                'order' => 3,
            ],
        ];

        foreach ($values as $value) {
            CompanyValue::updateOrCreate(
                ['title' => $value['title']],
                $value
            );
        }
    }
}
