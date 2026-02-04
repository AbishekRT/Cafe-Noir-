<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * ContactController
 * 
 * Handles the contact page and form submissions.
 */
class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Store a contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
