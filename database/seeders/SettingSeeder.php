<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'company_name', 'value' => 'Elevasi Design Build', 'group' => 'general'],
            ['key' => 'company_tagline', 'value' => 'Building Tomorrow\'s Spaces', 'group' => 'general'],
            ['key' => 'company_description', 'value' => 'Where architectural elegance meets precision engineering. We craft environments that define the future of living.', 'group' => 'general'],
            ['key' => 'established_year', 'value' => '2008', 'group' => 'general'],

            // Contact Settings
            ['key' => 'address', 'value' => 'Jl. Arsitektur No. 123, Jakarta Selatan, Indonesia 12345', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+62 21 555 0123', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'hello@elevasi.co.id', 'group' => 'contact'],
            ['key' => 'whatsapp', 'value' => '+6281234567890', 'group' => 'contact'],

            // Social Media
            ['key' => 'instagram', 'value' => 'https://instagram.com/elevasi.design', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/elevasi-design-build', 'group' => 'social'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/elevasidesign', 'group' => 'social'],

            // Stats
            ['key' => 'years_in_business', 'value' => '15', 'group' => 'stats'],
            ['key' => 'projects_completed', 'value' => '120', 'group' => 'stats'],
            ['key' => 'design_awards', 'value' => '8', 'group' => 'stats'],

            // Hero Section
            ['key' => 'hero_title', 'value' => "Building\nTomorrow's Spaces", 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Where architectural elegance meets precision engineering. We craft environments that define the future of living.', 'group' => 'hero'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
