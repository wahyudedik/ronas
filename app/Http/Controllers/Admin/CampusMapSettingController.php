<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusMapSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusMapSettingController extends Controller
{
    public function index(): View
    {
        $settings = CampusMapSetting::query()
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.facilities.map-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('admin.facilities.map-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSetting($request);
        CampusMapSetting::create($validated);

        return redirect()
            ->route('admin.facilities.map-settings.index')
            ->with('status', 'Map setting saved.');
    }

    public function edit(CampusMapSetting $mapSetting): View
    {
        return view('admin.facilities.map-settings.edit', compact('mapSetting'));
    }

    public function update(Request $request, CampusMapSetting $mapSetting): RedirectResponse
    {
        $validated = $this->validateSetting($request);
        $mapSetting->update($validated);

        return redirect()
            ->route('admin.facilities.map-settings.index')
            ->with('status', 'Map setting updated.');
    }

    public function toggle(Request $request, CampusMapSetting $mapSetting): JsonResponse|RedirectResponse
    {
        $mapSetting->update(['is_active' => ! $mapSetting->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $mapSetting->is_active]);
        }

        return redirect()
            ->route('admin.facilities.map-settings.index')
            ->with('status', 'Map setting visibility updated.');
    }

    private function validateSetting(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'embed_url' => ['nullable', 'string', 'max:255'],
            'location_title' => ['nullable', 'string', 'max:255'],
            'location_address' => ['nullable', 'string', 'max:255'],
            'stat_one_icon' => ['nullable', 'string', 'max:100'],
            'stat_one_label' => ['nullable', 'string', 'max:100'],
            'stat_two_icon' => ['nullable', 'string', 'max:100'],
            'stat_two_label' => ['nullable', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
