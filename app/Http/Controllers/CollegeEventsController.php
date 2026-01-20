<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class CollegeEventsController extends Controller
{
    public function index(): View
    {
        $events = Event::query()
            ->where('is_active', true)
            ->orderBy('event_date')
            ->orderBy('sort_order')
            ->paginate(12);

        return view('college.events', compact('events'));
    }

    public function show(Event $event): View
    {
        if (!$event->is_active) {
            abort(404);
        }

        $relatedEvents = Event::query()
            ->where('is_active', true)
            ->where('id', '!=', $event->id)
            ->where('category', $event->category)
            ->orderBy('event_date')
            ->take(3)
            ->get();

        return view('college.event-details', compact('event', 'relatedEvents'));
    }
}
