<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'key' => 'about_section',
                'value' => "We don't just build walls; we craft environments that inspire. Our mission is to bridge the gap between functional construction and artistic expression, treating every blueprint as a promise of quality.",
                'group' => 'about',
            ],
            [
                'key' => 'our_people_section',
                'value' => 'A collective of visionaries, engineers, and artisans dedicated to the art of building.',
                'group' => 'about',
            ],
            [
                'key' => 'the_journey_section',
                'value' => 'From humble beginnings to industry leaders, our journey has been one of continuous innovation and unwavering commitment to excellence in construction.',
                'group' => 'about',
            ],
            [
                'key' => 'the_blueprint_section',
                'value' => 'Our core values guide every project we undertake, ensuring quality, sustainability, and innovation in every structure we build.',
                'group' => 'about',
            ],
        ];

        foreach ($sections as $section) {
            Setting::updateOrCreate(
                ['key' => $section['key']],
                [
                    'value' => $section['value'],
                    'group' => $section['group'],
                ]
            );
        }
    }
}
