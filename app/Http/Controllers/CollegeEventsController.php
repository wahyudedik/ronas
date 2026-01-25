<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CollegeEventsController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::query()->with('category')->where('is_active', true);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by status (upcoming/past), default to upcoming
        if ($request->get('view') === 'past') {
            $query->past();
        } else {
            $query->upcoming();
        }

        $events = $query->paginate(12);
        $categories = EventCategory::all();

        return view('college.events', compact('events', 'categories'));
    }

    public function show(Event $event): View
    {
        if (!$event->is_active) {
            abort(404);
        }

        $relatedEvents = Event::upcoming()
            ->where('id', '!=', $event->id)
            ->where('category_id', $event->category_id)
            ->take(3)
            ->get();

        return view('college.event-details', compact('event', 'relatedEvents'));
    }

    public function register(Request $request, Event $event): RedirectResponse
    {
        if ($event->status !== 'upcoming' || !$event->is_active) {
            return back()->with('error', 'Registration is not available for this event.');
        }

        if ($event->registration_deadline && $event->registration_deadline->isPast()) {
            return back()->with('error', 'Registration deadline has passed.');
        }

        if ($event->capacity && $event->registrations()->where('status', 'confirmed')->count() >= $event->capacity) {
            return back()->with('error', 'Event is fully booked.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $registration = new EventRegistration($validated);
        $registration->event_id = $event->id;
        $registration->user_id = Auth::id(); // Nullable
        $registration->status = 'pending'; // Or confirmed if no approval needed
        $registration->save();

        return back()->with('success', 'Registration submitted successfully!');
    }
}
