<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::latest();
        
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $messages = $query->paginate(10);
        return view('admin.contact.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }
        return view('admin.contact.messages.show', compact('message'));
    }

    public function update(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied',
        ]);

        $message->update($validated);

        return redirect()->route('admin.contact.messages.index')->with('success', 'Message status updated.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.contact.messages.index')->with('success', 'Message deleted successfully.');
    }
}
