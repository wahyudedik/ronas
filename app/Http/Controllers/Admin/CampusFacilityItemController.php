<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusFacilityCategory;
use App\Models\CampusFacilityItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusFacilityItemController extends Controller
{
    public function index(): View
    {
        $items = CampusFacilityItem::query()
            ->with('category')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.facilities.items.index', compact('items'));
    }

    public function create(): View
    {
        $categories = CampusFacilityCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.facilities.items.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateItem($request);
        CampusFacilityItem::create($validated);

        return redirect()
            ->route('admin.facilities.items.index')
            ->with('status', 'Facility item saved.');
    }

    public function edit(CampusFacilityItem $item): View
    {
        $categories = CampusFacilityCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.facilities.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, CampusFacilityItem $item): RedirectResponse
    {
        $validated = $this->validateItem($request);
        $item->update($validated);

        return redirect()
            ->route('admin.facilities.items.index')
            ->with('status', 'Facility item updated.');
    }

    public function destroy(CampusFacilityItem $item): RedirectResponse
    {
        $item->delete();

        return redirect()
            ->route('admin.facilities.items.index')
            ->with('status', 'Facility item deleted.');
    }

    public function toggle(Request $request, CampusFacilityItem $item): JsonResponse|RedirectResponse
    {
        $item->update(['is_active' => ! $item->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $item->is_active]);
        }

        return redirect()
            ->route('admin.facilities.items.index')
            ->with('status', 'Facility item visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            CampusFacilityItem::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.facilities.items.index')
            ->with('status', 'Facility item order updated.');
    }

    private function validateItem(Request $request): array
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:campus_facility_categories,id'],
            'label' => ['required', 'string', 'max:255'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
