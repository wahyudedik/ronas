<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutLeadershipSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutLeadershipSectionController extends Controller
{
    public function index(): View
    {
        $sections = AboutLeadershipSection::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.about.leadership-sections.index', compact('sections'));
    }

    public function create(): View
    {
        return view('admin.about.leadership-sections.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSection($request);
        $this->handleImageUpload($request, $validated);

        AboutLeadershipSection::create($validated);

        return redirect()
            ->route('admin.about.leadership-sections.index')
            ->with('status', 'Leadership section saved.');
    }

    public function edit(AboutLeadershipSection $leadershipSection): View
    {
        return view('admin.about.leadership-sections.edit', compact('leadershipSection'));
    }

    public function update(Request $request, AboutLeadershipSection $leadershipSection): RedirectResponse
    {
        $validated = $this->validateSection($request);
        $this->handleImageUpload($request, $validated, $leadershipSection->image);

        $leadershipSection->update($validated);

        return redirect()
            ->route('admin.about.leadership-sections.index')
            ->with('status', 'Leadership section updated.');
    }

    public function destroy(AboutLeadershipSection $leadershipSection): RedirectResponse
    {
        $this->deleteOldImage($leadershipSection->image);
        $leadershipSection->delete();

        return redirect()
            ->route('admin.about.leadership-sections.index')
            ->with('status', 'Leadership section deleted.');
    }

    public function toggle(Request $request, AboutLeadershipSection $leadershipSection): JsonResponse|RedirectResponse
    {
        $leadershipSection->update(['is_active' => ! $leadershipSection->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $leadershipSection->is_active]);
        }

        return redirect()
            ->route('admin.about.leadership-sections.index')
            ->with('status', 'Leadership section visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AboutLeadershipSection::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.about.leadership-sections.index')
            ->with('status', 'Leadership section order updated.');
    }

    private function validateSection(Request $request): array
    {
        $validated = $request->validate([
            'subtitle' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'experience_years' => ['nullable', 'string', 'max:50'],
            'experience_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('about', 'public');
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
