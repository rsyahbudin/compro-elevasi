<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(): Response
    {
        $messages = ContactMessage::latest()
            ->paginate(20)
            ->withQueryString();

        $unreadCount = ContactMessage::unread()->count();

        return Inertia::render('admin/messages/Index', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Display the specified message.
     */
    public function show(ContactMessage $message): Response
    {
        // Mark as read when viewed
        $message->markAsRead();

        return Inertia::render('admin/messages/Show', [
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified message.
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
