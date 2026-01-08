<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $featuredProjects = Project::with('category')
            ->published()
            ->featured()
            ->latest()
            ->take(4)
            ->get();

        $stats = Setting::getByGroup('stats');
        $hero = Setting::getByGroup('hero');
        $general = Setting::getByGroup('general');

        return Inertia::render('Home', [
            'featuredProjects' => $featuredProjects,
            'stats' => [
                'years' => $stats['years_in_business'] ?? '15+',
                'projects' => $stats['projects_completed'] ?? '120+',
                'awards' => $stats['design_awards'] ?? '8',
            ],
            'hero' => [
                'title' => $hero['hero_title'] ?? "Building\nTomorrow's Spaces",
                'subtitle' => $hero['hero_subtitle'] ?? 'Where architectural elegance meets precision engineering.',
            ],
            'company' => [
                'name' => $general['company_name'] ?? 'Elevasi Design Build',
                'established' => $general['established_year'] ?? '2008',
            ],
        ]);
    }
}
