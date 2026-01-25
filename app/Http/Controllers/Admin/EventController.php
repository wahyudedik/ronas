<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::with('category')
            ->orderBy('start_date')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        $categories = EventCategory::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateEvent($request);
        $this->handleImageUpload($request, $validated);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event saved.');
    }

    public function edit(Event $event): View
    {
        $categories = EventCategory::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $this->validateEvent($request);
        $this->handleImageUpload($request, $validated, $event->image);

        // Generate slug if title changed and slug not provided
        if ($event->title !== $validated['title'] && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event updated.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->deleteOldImage($event->image);
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event deleted.');
    }

    private function validateEvent(Request $request): array
    {
        $eventId = $request->route('event')?->id ?? null;
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:events,slug,' . $eventId],
            'category_id' => ['nullable', 'exists:event_categories,id'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'venue' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'capacity' => ['nullable', 'integer', 'min:0'],
            'registration_deadline' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
            'registration_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'status' => ['required', 'in:upcoming,ongoing,past,cancelled'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = 'storage/' . $path;
            $this->deleteOldImage($existingImage);
        }
    }

    private function deleteOldImage(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'storage/')) {
            return;
        }

        $relative = substr($path, strlen('storage/'));
        if ($relative !== '') {
            Storage::disk('public')->delete($relative);
        }
    }
}
