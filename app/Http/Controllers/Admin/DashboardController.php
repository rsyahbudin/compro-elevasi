<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Dashboard', [
            'stats' => [
                'totalProjects' => Project::count(),
                'publishedProjects' => Project::published()->count(),
                'featuredProjects' => Project::featured()->count(),
                'categories' => Category::count(),
            ],
            'recentProjects' => Project::with('category')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
