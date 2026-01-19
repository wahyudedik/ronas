<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutHistoryController extends Controller
{
    public function index(): View
    {
        $histories = AboutHistory::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.about.histories.index', compact('histories'));
    }

    public function create(): View
    {
        return view('admin.about.histories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateHistory($request);
        $this->handleImageUpload($request, $validated);

        AboutHistory::create($validated);

        return redirect()
            ->route('admin.about.histories.index')
            ->with('status', 'History saved.');
    }

    public function edit(AboutHistory $history): View
    {
        return view('admin.about.histories.edit', compact('history'));
    }

    public function update(Request $request, AboutHistory $history): RedirectResponse
    {
        $validated = $this->validateHistory($request);
        $this->handleImageUpload($request, $validated, $history->image);

        $history->update($validated);

        return redirect()
            ->route('admin.about.histories.index')
            ->with('status', 'History updated.');
    }

    public function destroy(AboutHistory $history): RedirectResponse
    {
        $this->deleteOldImage($history->image);
        $history->delete();

        return redirect()
            ->route('admin.about.histories.index')
            ->with('status', 'History deleted.');
    }

    public function toggle(Request $request, AboutHistory $history): JsonResponse|RedirectResponse
    {
        $history->update(['is_active' => ! $history->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $history->is_active]);
        }

        return redirect()
            ->route('admin.about.histories.index')
            ->with('status', 'History visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AboutHistory::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.about.histories.index')
            ->with('status', 'History order updated.');
    }

    private function validateHistory(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'heading' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
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
