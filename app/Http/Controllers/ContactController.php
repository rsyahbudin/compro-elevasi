<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
                'whatsapp' => $contact['whatsapp'] ?? '',
                'operating_hours' => $contact['operating_hours'] ?? 'Mon-Fri, 9am - 6pm WIB',
                'map_url' => $contact['map_url'] ?? '',
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

        // Save message to database
        $contactMessage = ContactMessage::create($validated);

        // Send email notification to company
        $companyEmail = Setting::get('email') ?? config('mail.from.address');

        try {
            Mail::to($companyEmail)->send(new ContactMessageReceived($contactMessage));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send contact message email: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
