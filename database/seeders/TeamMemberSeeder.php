<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Sarah Chen',
                'role' => 'Lead Architect',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=500&fit=crop',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Marcus Johnson',
                'role' => 'Project Director',
                'photo' => 'https://images.unsplash.com/photo-1556157382-97eda2d62296?w=400&h=500&fit=crop',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Elena Rodriguez',
                'role' => 'Senior Designer',
                'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&h=500&fit=crop',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'James Park',
                'role' => 'Chief Engineer',
                'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=500&fit=crop',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                $member
            );
        }
    }
}
