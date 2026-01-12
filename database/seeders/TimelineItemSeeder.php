<?php

namespace Database\Seeders;

use App\Models\TimelineItem;
use Illuminate\Database\Seeder;

class TimelineItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'year' => '2015',
                'title' => 'Foundation',
                'description' => 'Started with a vision to revolutionize construction through innovative design and sustainable practices.',
                'order' => 1,
            ],
            [
                'year' => '2017',
                'title' => 'Expansion',
                'description' => 'Grew our team and expanded services to include commercial and residential projects across the region.',
                'order' => 2,
            ],
            [
                'year' => '2020',
                'title' => 'Recognition',
                'description' => 'Received multiple industry awards for design excellence and sustainable construction methods.',
                'order' => 3,
            ],
            [
                'year' => '2024',
                'title' => 'Innovation',
                'description' => 'Pioneered new construction technologies and became a leader in sustainable architecture.',
                'order' => 4,
            ],
        ];

        foreach ($items as $item) {
            TimelineItem::updateOrCreate(
                ['year' => $item['year'], 'title' => $item['title']],
                $item
            );
        }
    }
}
