<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

/**
 * ContactController
 * 
 * Handles contact message management in the admin panel.
 */
class ContactController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index()
    {
        $contacts = Contact::with('readByUser')
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $unreadCount = Contact::unread()->count();

        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(Contact $contact)
    {
        // Mark as read when viewing
        if (!$contact->is_read) {
            $contact->markAsRead(auth()->id());
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact message.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Mark a contact as read.
     */
    public function markAsRead(Contact $contact)
    {
        $contact->markAsRead(auth()->id());

        return back()->with('success', 'Message marked as read.');
    }
}
