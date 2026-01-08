<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $projects = [
            [
                'title' => 'The Glass House Residence',
                'location' => 'Jakarta, Indonesia',
                'area' => '450 sqm',
                'scope' => 'Architecture, Interior & Exterior Build',
                'description' => "The Glass House Residence was conceived as a dialogue between nature and modern living. Faced with the challenge of a sloping terrain, our team utilized a cantilevered structure to minimize the footprint on the land while maximizing panoramic views of the surrounding valley. The primary goal was to dissolve the boundaries between the interior and exterior.\n\nMaterials were chosen for their raw honesty and ability to age gracefully. Exposed reinforced concrete provides the structural backbone, softened by the warmth of locally sourced teak wood cladding. Extensive floor-to-ceiling glazing allows natural light to flood the living spaces throughout the day, creating an ever-changing play of shadows and reflections.",
                'category' => 'Residential',
                'is_featured' => true,
            ],
            [
                'title' => 'The Highland Residence',
                'location' => 'Bandung, Indonesia',
                'area' => '380 sqm',
                'scope' => 'Full Construction',
                'description' => 'A modern residential villa designed to embrace the cool highland climate. Features extensive wooden deck and swimming pool area.',
                'category' => 'Residential',
                'is_featured' => true,
            ],
            [
                'title' => 'Apex Corporate HQ',
                'location' => 'Jakarta, Indonesia',
                'area' => '2500 sqm',
                'scope' => 'Commercial Build',
                'description' => 'Minimalist modern office interior with glass walls and contemporary furniture. Designed for maximum productivity and employee wellbeing.',
                'category' => 'Commercial',
                'is_featured' => true,
            ],
            [
                'title' => 'Azure Boutique Hotel',
                'location' => 'Bali, Indonesia',
                'area' => '1200 sqm',
                'scope' => 'Hospitality Design & Build',
                'description' => 'Luxury boutique hotel featuring marble floors and dramatic lighting. Each room designed to provide a unique experience.',
                'category' => 'Commercial',
                'is_featured' => true,
            ],
            [
                'title' => 'Modern Art Wing',
                'location' => 'Surabaya, Indonesia',
                'area' => '800 sqm',
                'scope' => 'Renovation & Interior Design',
                'description' => 'Abstract architectural detail featuring concrete walls with geometric shadows. A cultural space that inspires creativity.',
                'category' => 'Renovation',
                'is_featured' => false,
            ],
            [
                'title' => 'Urban Coffee Hub',
                'location' => 'Yogyakarta, Indonesia',
                'area' => '150 sqm',
                'scope' => 'Interior Fit-out',
                'description' => 'Contemporary coffee shop interior with modern kitchen and cozy seating areas.',
                'category' => 'Interior',
                'is_featured' => false,
            ],
            [
                'title' => 'Oasis Resort',
                'location' => 'Lombok, Indonesia',
                'area' => '5000 sqm',
                'scope' => 'Landscape Design',
                'description' => 'Resort landscape featuring natural pools and tropical gardens. Designed to harmonize with the surrounding environment.',
                'category' => 'Landscape',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $projectData) {
            $category = $categories->where('name', $projectData['category'])->first();

            Project::create([
                'category_id' => $category->id,
                'title' => $projectData['title'],
                'slug' => Str::slug($projectData['title']),
                'location' => $projectData['location'],
                'completion_date' => now()->subMonths(rand(1, 24)),
                'area' => $projectData['area'],
                'scope' => $projectData['scope'],
                'description' => $projectData['description'],
                'is_featured' => $projectData['is_featured'],
                'is_published' => true,
            ]);
        }
    }
}
