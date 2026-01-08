<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(Request $request): Response
    {
        $categories = Category::orderBy('order')->get();

        $projectsQuery = Project::with('category')
            ->published()
            ->latest();

        if ($request->has('category') && $request->category) {
            $projectsQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        $projects = $projectsQuery->paginate(12)->withQueryString();

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'categories' => $categories,
            'activeCategory' => $request->category,
        ]);
    }

    public function show(Project $project): Response
    {
        $project->load(['category', 'images']);

        $previousProject = Project::published()
            ->where('id', '<', $project->id)
            ->orderBy('id', 'desc')
            ->first(['id', 'title', 'slug']);

        $nextProject = Project::published()
            ->where('id', '>', $project->id)
            ->orderBy('id', 'asc')
            ->first(['id', 'title', 'slug']);

        return Inertia::render('Projects/Show', [
            'project' => $project,
            'previousProject' => $previousProject,
            'nextProject' => $nextProject,
        ]);
    }
}
