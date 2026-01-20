<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusMapAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusMapActionController extends Controller
{
    public function index(): View
    {
        $actions = CampusMapAction::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.facilities.map-actions.index', compact('actions'));
    }

    public function create(): View
    {
        return view('admin.facilities.map-actions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAction($request);
        CampusMapAction::create($validated);

        return redirect()
            ->route('admin.facilities.map-actions.index')
            ->with('status', 'Map action saved.');
    }

    public function edit(CampusMapAction $mapAction): View
    {
        return view('admin.facilities.map-actions.edit', compact('mapAction'));
    }

    public function update(Request $request, CampusMapAction $mapAction): RedirectResponse
    {
        $validated = $this->validateAction($request);
        $mapAction->update($validated);

        return redirect()
            ->route('admin.facilities.map-actions.index')
            ->with('status', 'Map action updated.');
    }

    public function destroy(CampusMapAction $mapAction): RedirectResponse
    {
        $mapAction->delete();

        return redirect()
            ->route('admin.facilities.map-actions.index')
            ->with('status', 'Map action deleted.');
    }

    public function toggle(Request $request, CampusMapAction $mapAction): JsonResponse|RedirectResponse
    {
        $mapAction->update(['is_active' => ! $mapAction->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $mapAction->is_active]);
        }

        return redirect()
            ->route('admin.facilities.map-actions.index')
            ->with('status', 'Map action visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            CampusMapAction::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.facilities.map-actions.index')
            ->with('status', 'Map action order updated.');
    }

    private function validateAction(Request $request): array
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
