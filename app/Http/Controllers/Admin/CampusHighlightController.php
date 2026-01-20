<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusHighlight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CampusHighlightController extends Controller
{
    public function index(): View
    {
        $highlights = CampusHighlight::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.facilities.highlights.index', compact('highlights'));
    }

    public function create(): View
    {
        return view('admin.facilities.highlights.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateHighlight($request);
        $this->handleImageUpload($request, $validated);
        CampusHighlight::create($validated);

        return redirect()
            ->route('admin.facilities.highlights.index')
            ->with('status', 'Highlight saved.');
    }

    public function edit(CampusHighlight $highlight): View
    {
        return view('admin.facilities.highlights.edit', compact('highlight'));
    }

    public function update(Request $request, CampusHighlight $highlight): RedirectResponse
    {
        $validated = $this->validateHighlight($request);
        $this->handleImageUpload($request, $validated, $highlight->image);
        $highlight->update($validated);

        return redirect()
            ->route('admin.facilities.highlights.index')
            ->with('status', 'Highlight updated.');
    }

    public function destroy(CampusHighlight $highlight): RedirectResponse
    {
        $this->deleteOldImage($highlight->image);
        $highlight->delete();

        return redirect()
            ->route('admin.facilities.highlights.index')
            ->with('status', 'Highlight deleted.');
    }

    public function toggle(Request $request, CampusHighlight $highlight): JsonResponse|RedirectResponse
    {
        $highlight->update(['is_active' => ! $highlight->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $highlight->is_active]);
        }

        return redirect()
            ->route('admin.facilities.highlights.index')
            ->with('status', 'Highlight visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            CampusHighlight::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.facilities.highlights.index')
            ->with('status', 'Highlight order updated.');
    }

    private function validateHighlight(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_label' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'stat_one_icon' => ['nullable', 'string', 'max:100'],
            'stat_one_label' => ['nullable', 'string', 'max:100'],
            'stat_two_icon' => ['nullable', 'string', 'max:100'],
            'stat_two_label' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('campus-facilities', 'public');
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
