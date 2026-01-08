<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(): Response
    {
        $contact = Setting::getByGroup('contact');

        return Inertia::render('Contact', [
            'contact' => [
                'address' => $contact['address'] ?? 'Jl. Arsitektur No. 123, Jakarta Selatan, Indonesia',
                'phone' => $contact['phone'] ?? '+62 21 555 0123',
                'email' => $contact['email'] ?? 'hello@elevasi.co.id',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // TODO: Send email notification or store in database
        // For now, just redirect with success message

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
