<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusVirtualTour;
use App\Models\CampusVirtualTourFeature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusVirtualTourFeatureController extends Controller
{
    public function index(): View
    {
        $features = CampusVirtualTourFeature::query()
            ->with('tour')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.facilities.virtual-tour-features.index', compact('features'));
    }

    public function create(): View
    {
        $tours = CampusVirtualTour::query()
            ->orderByDesc('id')
            ->get();

        return view('admin.facilities.virtual-tour-features.create', compact('tours'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateFeature($request);
        CampusVirtualTourFeature::create($validated);

        return redirect()
            ->route('admin.facilities.virtual-tour-features.index')
            ->with('status', 'Virtual tour feature saved.');
    }

    public function edit(CampusVirtualTourFeature $feature): View
    {
        $tours = CampusVirtualTour::query()
            ->orderByDesc('id')
            ->get();

        return view('admin.facilities.virtual-tour-features.edit', compact('feature', 'tours'));
    }

    public function update(Request $request, CampusVirtualTourFeature $feature): RedirectResponse
    {
        $validated = $this->validateFeature($request);
        $feature->update($validated);

        return redirect()
            ->route('admin.facilities.virtual-tour-features.index')
            ->with('status', 'Virtual tour feature updated.');
    }

    public function destroy(CampusVirtualTourFeature $feature): RedirectResponse
    {
        $feature->delete();

        return redirect()
            ->route('admin.facilities.virtual-tour-features.index')
            ->with('status', 'Virtual tour feature deleted.');
    }

    public function toggle(Request $request, CampusVirtualTourFeature $feature): JsonResponse|RedirectResponse
    {
        $feature->update(['is_active' => ! $feature->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $feature->is_active]);
        }

        return redirect()
            ->route('admin.facilities.virtual-tour-features.index')
            ->with('status', 'Virtual tour feature visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            CampusVirtualTourFeature::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.facilities.virtual-tour-features.index')
            ->with('status', 'Virtual tour feature order updated.');
    }

    private function validateFeature(Request $request): array
    {
        $validated = $request->validate([
            'campus_virtual_tour_id' => ['required', 'exists:campus_virtual_tours,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
