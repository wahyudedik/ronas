<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingStat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingStatController extends Controller
{
    public function index(): View
    {
        $stats = LandingStat::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.landing.stats.index', compact('stats'));
    }

    public function create(): View
    {
        return view('admin.landing.stats.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateStat($request);
        LandingStat::create($validated);

        return redirect()
            ->route('admin.landing.stats.index')
            ->with('status', 'Stat saved.');
    }

    public function edit(LandingStat $stat): View
    {
        return view('admin.landing.stats.edit', compact('stat'));
    }

    public function update(Request $request, LandingStat $stat): RedirectResponse
    {
        $validated = $this->validateStat($request);
        $stat->update($validated);

        return redirect()
            ->route('admin.landing.stats.index')
            ->with('status', 'Stat updated.');
    }

    public function destroy(LandingStat $stat): RedirectResponse
    {
        $stat->delete();

        return redirect()
            ->route('admin.landing.stats.index')
            ->with('status', 'Stat deleted.');
    }

    public function toggle(Request $request, LandingStat $stat): JsonResponse|RedirectResponse
    {
        $stat->update(['is_active' => ! $stat->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $stat->is_active]);
        }

        return redirect()
            ->route('admin.landing.stats.index')
            ->with('status', 'Stat visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingStat::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.stats.index')
            ->with('status', 'Stat order updated.');
    }

    private function validateStat(Request $request): array
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:50'],
            'suffix' => ['nullable', 'string', 'max:20'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
