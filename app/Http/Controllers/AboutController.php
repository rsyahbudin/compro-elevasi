<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    public function index(): Response
    {
        $general = Setting::getByGroup('general');
        $stats = Setting::getByGroup('stats');

        $timeline = [
            [
                'year' => '2008',
                'title' => 'The Foundation',
                'description' => 'Started as a boutique design studio in Jakarta, focusing on residential renovations that prioritized sustainable materials.',
            ],
            [
                'year' => '2012',
                'title' => 'Commercial Scale',
                'description' => 'Secured our first major commercial contract, marking our entry into large-scale urban development projects.',
            ],
            [
                'year' => '2018',
                'title' => 'Design Award',
                'description' => 'Recognized internationally with the Sustainable Design Award for integrating vertical gardens into high-density office spaces.',
            ],
            [
                'year' => '2023',
                'title' => 'National Expansion',
                'description' => 'Expanded operations across Indonesia with offices in Surabaya and Bali, bringing our unique philosophy nationwide.',
            ],
        ];

        $values = [
            [
                'icon' => 'precision_manufacturing',
                'title' => 'Precision',
                'description' => 'Every millimeter counts. We employ advanced BIM modeling and precision fabrication to ensure the physical structure matches the digital dream perfectly.',
            ],
            [
                'icon' => 'eco',
                'title' => 'Sustainability',
                'description' => "We don't just reduce harm; we create regenerative systems. Our buildings are designed to harvest energy, purify air, and contribute to the ecosystem.",
            ],
            [
                'icon' => 'psychology',
                'title' => 'Innovation',
                'description' => 'Challenging the status quo is in our DNA. From self-healing concrete to kinetic facades, we constantly explore the frontier of material science.',
            ],
        ];

        $team = [
            [
                'name' => 'Ahmad Prasetyo',
                'role' => 'Founder & CEO',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400',
            ],
            [
                'name' => 'Sarah Wijaya',
                'role' => 'Lead Architect',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400',
            ],
            [
                'name' => 'David Kurniawan',
                'role' => 'Chief Engineer',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
            ],
            [
                'name' => 'Elena Santoso',
                'role' => 'Design Director',
                'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400',
            ],
        ];

        return Inertia::render('About', [
            'company' => [
                'name' => $general['company_name'] ?? 'Elevasi Design Build',
                'established' => $general['established_year'] ?? '2008',
            ],
            'stats' => [
                'years' => $stats['years_in_business'] ?? '15',
                'projects' => $stats['projects_completed'] ?? '120',
                'awards' => $stats['design_awards'] ?? '8',
            ],
            'timeline' => $timeline,
            'values' => $values,
            'team' => $team,
        ]);
    }
}
