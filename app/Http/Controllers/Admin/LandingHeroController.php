<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingHero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LandingHeroController extends Controller
{
    public function index(): View
    {
        $heroes = LandingHero::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.landing.heroes.index', compact('heroes'));
    }

    public function create(): View
    {
        return view('admin.landing.heroes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateHero($request);
        $this->handleImageUpload($request, $validated);

        LandingHero::create($validated);

        return redirect()
            ->route('admin.landing.heroes.index')
            ->with('status', 'Hero saved.');
    }

    public function edit(LandingHero $hero): View
    {
        return view('admin.landing.heroes.edit', compact('hero'));
    }

    public function update(Request $request, LandingHero $hero): RedirectResponse
    {
        $validated = $this->validateHero($request);
        $this->handleImageUpload($request, $validated, $hero->image);

        $hero->update($validated);

        return redirect()
            ->route('admin.landing.heroes.index')
            ->with('status', 'Hero updated.');
    }

    public function destroy(LandingHero $hero): RedirectResponse
    {
        $this->deleteOldImage($hero->image);
        $hero->delete();

        return redirect()
            ->route('admin.landing.heroes.index')
            ->with('status', 'Hero deleted.');
    }

    public function toggle(Request $request, LandingHero $hero): JsonResponse|RedirectResponse
    {
        $hero->update(['is_active' => ! $hero->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $hero->is_active]);
        }

        return redirect()
            ->route('admin.landing.heroes.index')
            ->with('status', 'Hero visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingHero::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.heroes.index')
            ->with('status', 'Hero order updated.');
    }

    private function validateHero(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'primary_label' => ['nullable', 'string', 'max:255'],
            'primary_url' => ['nullable', 'string', 'max:255'],
            'secondary_label' => ['nullable', 'string', 'max:255'],
            'secondary_url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'badge_text' => ['nullable', 'string', 'max:255'],
            'badge_icon' => ['nullable', 'string', 'max:255'],
            'stat_one_value' => ['nullable', 'string', 'max:50'],
            'stat_one_label' => ['nullable', 'string', 'max:100'],
            'stat_two_value' => ['nullable', 'string', 'max:50'],
            'stat_two_label' => ['nullable', 'string', 'max:100'],
            'stat_three_value' => ['nullable', 'string', 'max:50'],
            'stat_three_label' => ['nullable', 'string', 'max:100'],
            'event_day' => ['nullable', 'string', 'max:10'],
            'event_month' => ['nullable', 'string', 'max:10'],
            'event_title' => ['nullable', 'string', 'max:255'],
            'event_description' => ['nullable', 'string'],
            'event_button_label' => ['nullable', 'string', 'max:255'],
            'event_button_url' => ['nullable', 'string', 'max:255'],
            'event_countdown_text' => ['nullable', 'string', 'max:255'],
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
