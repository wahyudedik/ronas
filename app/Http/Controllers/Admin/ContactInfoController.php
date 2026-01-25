<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        return view('admin.contact.info.index', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('admin.contact.info.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'operating_hours' => 'nullable|array',
            'social_media_links' => 'nullable|array',
        ]);

        $contact->update($validated);

        return redirect()->route('admin.contact.info.index')->with('success', 'Contact information updated successfully.');
    }
    
    // Create/Store methods can be added if we support multiple contacts, but requirements imply a single organization contact
    // For now we assume one main contact record seeded initially.
}
