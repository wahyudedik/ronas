<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\ContactSetting;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        $settings = ContactSetting::pluck('value', 'key');
        return view('college.contact', compact('contact', 'settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Basic spam protection (honeypot or similar could be added here)
        
        ContactMessage::create($validated);

        return redirect()->route('college.contact')->with('success', 'Your message has been sent. Thank you!');
    }
}
