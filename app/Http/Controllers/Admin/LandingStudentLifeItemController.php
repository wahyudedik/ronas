<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingStudentLifeItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LandingStudentLifeItemController extends Controller
{
    public function index(): View
    {
        $items = LandingStudentLifeItem::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.landing.student-life.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.landing.student-life.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateItem($request);
        $this->handleImageUpload($request, $validated);
        LandingStudentLifeItem::create($validated);

        return redirect()
            ->route('admin.landing.student-life.index')
            ->with('status', 'Item saved.');
    }

    public function edit(LandingStudentLifeItem $student_life): View
    {
        $item = $student_life;

        return view('admin.landing.student-life.edit', compact('item'));
    }

    public function update(Request $request, LandingStudentLifeItem $student_life): RedirectResponse
    {
        $validated = $this->validateItem($request);
        $this->handleImageUpload($request, $validated, $student_life->image);
        $student_life->update($validated);

        return redirect()
            ->route('admin.landing.student-life.index')
            ->with('status', 'Item updated.');
    }

    public function destroy(LandingStudentLifeItem $student_life): RedirectResponse
    {
        $this->deleteOldImage($student_life->image);
        $student_life->delete();

        return redirect()
            ->route('admin.landing.student-life.index')
            ->with('status', 'Item deleted.');
    }

    public function toggle(Request $request, LandingStudentLifeItem $student_life): JsonResponse|RedirectResponse
    {
        $student_life->update(['is_active' => ! $student_life->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $student_life->is_active]);
        }

        return redirect()
            ->route('admin.landing.student-life.index')
            ->with('status', 'Item visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingStudentLifeItem::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.student-life.index')
            ->with('status', 'Item order updated.');
    }

    private function validateItem(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'link_label' => ['nullable', 'string', 'max:100'],
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
