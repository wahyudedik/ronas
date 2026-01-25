<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AlumniEventController extends Controller
{
    public function index()
    {
        $events = AlumniEvent::latest()->paginate(10);
        return view('admin.alumni.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.alumni.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'registration_link' => 'nullable|url',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['event_name']);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('alumni/events', 'public');
            $validated['featured_image'] = 'storage/' . $path;
        }

        AlumniEvent::create($validated);

        return redirect()->route('admin.alumni.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(AlumniEvent $event)
    {
        return view('admin.alumni.events.edit', compact('event'));
    }

    public function update(Request $request, AlumniEvent $event)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'registration_link' => 'nullable|url',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($event->event_name !== $validated['event_name']) {
            $validated['slug'] = Str::slug($validated['event_name']);
        }

        if ($request->hasFile('featured_image')) {
            if ($event->featured_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $event->featured_image));
            }
            $path = $request->file('featured_image')->store('alumni/events', 'public');
            $validated['featured_image'] = 'storage/' . $path;
        }

        $event->update($validated);

        return redirect()->route('admin.alumni.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(AlumniEvent $event)
    {
        if ($event->featured_image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $event->featured_image));
        }
        $event->delete();

        return redirect()->route('admin.alumni.events.index')->with('success', 'Event deleted successfully.');
    }
}
