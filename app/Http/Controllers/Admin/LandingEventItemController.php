<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingEventItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LandingEventItemController extends Controller
{
    public function index(): View
    {
        $events = LandingEventItem::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.landing.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.landing.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateEvent($request);
        $this->handleImageUpload($request, $validated);
        LandingEventItem::create($validated);

        return redirect()
            ->route('admin.landing.events.index')
            ->with('status', 'Event saved.');
    }

    public function edit(LandingEventItem $event): View
    {
        return view('admin.landing.events.edit', compact('event'));
    }

    public function update(Request $request, LandingEventItem $event): RedirectResponse
    {
        $validated = $this->validateEvent($request);
        $this->handleImageUpload($request, $validated, $event->image);
        $event->update($validated);

        return redirect()
            ->route('admin.landing.events.index')
            ->with('status', 'Event updated.');
    }

    public function destroy(LandingEventItem $event): RedirectResponse
    {
        $this->deleteOldImage($event->image);
        $event->delete();

        return redirect()
            ->route('admin.landing.events.index')
            ->with('status', 'Event deleted.');
    }

    public function toggle(Request $request, LandingEventItem $event): JsonResponse|RedirectResponse
    {
        $event->update(['is_active' => ! $event->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $event->is_active]);
        }

        return redirect()
            ->route('admin.landing.events.index')
            ->with('status', 'Event visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingEventItem::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.events.index')
            ->with('status', 'Event order updated.');
    }

    private function validateEvent(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'time_text' => ['nullable', 'string', 'max:100'],
            'date_day' => ['nullable', 'string', 'max:10'],
            'date_month' => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'participants' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:2048'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('landing', 'public');
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
