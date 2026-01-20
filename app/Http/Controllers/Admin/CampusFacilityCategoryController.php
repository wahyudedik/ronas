<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusFacilityCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CampusFacilityCategoryController extends Controller
{
    public function index(): View
    {
        $categories = CampusFacilityCategory::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.facilities.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.facilities.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategory($request);
        $this->handleImageUpload($request, $validated);
        CampusFacilityCategory::create($validated);

        return redirect()
            ->route('admin.facilities.categories.index')
            ->with('status', 'Category saved.');
    }

    public function edit(CampusFacilityCategory $category): View
    {
        return view('admin.facilities.categories.edit', compact('category'));
    }

    public function update(Request $request, CampusFacilityCategory $category): RedirectResponse
    {
        $validated = $this->validateCategory($request);
        $this->handleImageUpload($request, $validated, $category->image);
        $category->update($validated);

        return redirect()
            ->route('admin.facilities.categories.index')
            ->with('status', 'Category updated.');
    }

    public function destroy(CampusFacilityCategory $category): RedirectResponse
    {
        $this->deleteOldImage($category->image);
        $category->delete();

        return redirect()
            ->route('admin.facilities.categories.index')
            ->with('status', 'Category deleted.');
    }

    public function toggle(Request $request, CampusFacilityCategory $category): JsonResponse|RedirectResponse
    {
        $category->update(['is_active' => ! $category->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $category->is_active]);
        }

        return redirect()
            ->route('admin.facilities.categories.index')
            ->with('status', 'Category visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            CampusFacilityCategory::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.facilities.categories.index')
            ->with('status', 'Category order updated.');
    }

    private function validateCategory(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'theme' => ['nullable', 'string', 'max:100'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:2048'],
            'button_label' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
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
