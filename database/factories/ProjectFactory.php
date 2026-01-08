<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'The Glass House Residence',
            'Azure Loft Project',
            'Vertex Office Complex',
            'Eco-Sustainable Villa',
            'Oasis Resort',
            'Urban Coffee Hub',
            'City Library Annex',
            'The Concrete Villa',
            'Skyline Office HQ',
            'Modern Living Spaces',
        ];

        $title = fake()->randomElement($titles);

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 1000),
            'location' => fake()->city().', '.fake()->country(),
            'completion_date' => fake()->dateTimeBetween('-3 years', 'now'),
            'area' => fake()->numberBetween(100, 1000).' sqm',
            'scope' => fake()->randomElement([
                'Architecture, Interior & Exterior Build',
                'Full Construction',
                'Renovation & Interior Design',
                'Landscape Design',
                'Commercial Fit-out',
            ]),
            'description' => fake()->paragraphs(3, true),
            'featured_image' => null,
            'is_featured' => fake()->boolean(30),
            'is_published' => fake()->boolean(90),
        ];
    }

    public function featured(): self
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'is_published' => true,
        ]);
    }

    public function published(): self
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
        ]);
    }
}
