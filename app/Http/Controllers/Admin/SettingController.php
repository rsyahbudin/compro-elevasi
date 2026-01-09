<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Settings', [
            'settings' => [
                'general' => Setting::getByGroup('general'),
                'contact' => Setting::getByGroup('contact'),
                'social' => Setting::getByGroup('social'),
                'stats' => Setting::getByGroup('stats'),
                'hero' => Setting::getByGroup('hero'),
                'branding' => Setting::getByGroup('branding'),
            ],
        ]);
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $groups = [
            'general' => ['company_name', 'company_tagline', 'company_description', 'established_year'],
            'contact' => ['address', 'phone', 'email', 'whatsapp'],
            'social' => ['instagram', 'linkedin', 'twitter'],
            'stats' => ['years_in_business', 'projects_completed', 'design_awards'],
            'hero' => ['hero_title', 'hero_subtitle'],
        ];

        foreach ($groups as $group => $keys) {
            foreach ($keys as $key) {
                if (array_key_exists($key, $validated) && $validated[$key] !== null) {
                    Setting::set($key, $validated[$key], $group);
                }
            }
        }

        // Handle logo uploads
        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo')->store('branding', 'public');
            Setting::set('logo', $path, 'branding');
        }

        if ($request->hasFile('logo_white')) {
            $oldLogo = Setting::get('logo_white');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo_white')->store('branding', 'public');
            Setting::set('logo_white', $path, 'branding');
        }

        // Clear all settings cache to ensure changes are immediately visible
        Setting::clearCache();

        return redirect()->back()
            ->with('success', 'Settings updated successfully.');
    }
}
