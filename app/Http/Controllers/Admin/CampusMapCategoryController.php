<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusMapCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusMapCategoryController extends Controller
{
    public function index(): View
    {
        $categories = CampusMapCategory::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.facilities.map-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.facilities.map-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategory($request);
        CampusMapCategory::create($validated);

        return redirect()
            ->route('admin.facilities.map-categories.index')
            ->with('status', 'Map category saved.');
    }

    public function edit(CampusMapCategory $mapCategory): View
    {
        return view('admin.facilities.map-categories.edit', compact('mapCategory'));
    }

    public function update(Request $request, CampusMapCategory $mapCategory): RedirectResponse
    {
        $validated = $this->validateCategory($request);
        $mapCategory->update($validated);

        return redirect()
            ->route('admin.facilities.map-categories.index')
            ->with('status', 'Map category updated.');
    }

    public function destroy(CampusMapCategory $mapCategory): RedirectResponse
    {
        $mapCategory->delete();

        return redirect()
            ->route('admin.facilities.map-categories.index')
            ->with('status', 'Map category deleted.');
    }

    public function toggle(Request $request, CampusMapCategory $mapCategory): JsonResponse|RedirectResponse
    {
        $mapCategory->update(['is_active' => ! $mapCategory->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $mapCategory->is_active]);
        }

        return redirect()
            ->route('admin.facilities.map-categories.index')
            ->with('status', 'Map category visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            CampusMapCategory::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.facilities.map-categories.index')
            ->with('status', 'Map category order updated.');
    }

    private function validateCategory(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'key' => ['nullable', 'string', 'max:100'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
