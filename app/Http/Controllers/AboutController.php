<?php

namespace App\Http\Controllers;

use App\Models\CompanyValue;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\TimelineItem;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    public function index(): Response
    {
        $about = Setting::getByGroup('about');
        $general = Setting::getByGroup('general');

        // Fetch from database instead of hardcoded
        $timeline = TimelineItem::ordered()->get()->map(function ($item) {
            return [
                'year' => $item->year,
                'title' => $item->title,
                'description' => $item->description,
            ];
        });

        $values = CompanyValue::ordered()->get()->map(function ($value) {
            return [
                'icon' => $value->icon,
                'title' => $value->title,
                'description' => $value->description,
            ];
        });

        $team = TeamMember::active()->get()->map(function ($member) {
            return [
                'name' => $member->name,
                'role' => $member->role,
                'image' => $member->photo,
            ];
        });

        return Inertia::render('About', [
            'about' => [
                'about_section' => $about['about_section'] ?? '',
                'our_people_section' => $about['our_people_section'] ?? '',
                'the_journey_section' => $about['the_journey_section'] ?? '',
                'the_blueprint_section' => $about['the_blueprint_section'] ?? '',
            ],
            'company' => [
                'name' => $general['company_name'] ?? 'Elevasi Design Build',
                'established' => $general['established_year'] ?? '2015',
            ],
            'stats' => [
                'years' => '9+',
                'projects' => '150+',
                'awards' => '25+',
            ],
            'timeline' => $timeline,
            'values' => $values,
            'team' => $team,
        ]);
    }
}
