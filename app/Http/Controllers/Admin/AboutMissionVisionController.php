<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMissionVision;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutMissionVisionController extends Controller
{
    public function index(): View
    {
        $missionVisions = AboutMissionVision::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.about.mission-visions.index', compact('missionVisions'));
    }

    public function create(): View
    {
        return view('admin.about.mission-visions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateMissionVision($request);

        AboutMissionVision::create($validated);

        return redirect()
            ->route('admin.about.mission-visions.index')
            ->with('status', 'Mission/Vision saved.');
    }

    public function edit(AboutMissionVision $missionVision): View
    {
        return view('admin.about.mission-visions.edit', compact('missionVision'));
    }

    public function update(Request $request, AboutMissionVision $missionVision): RedirectResponse
    {
        $validated = $this->validateMissionVision($request);

        $missionVision->update($validated);

        return redirect()
            ->route('admin.about.mission-visions.index')
            ->with('status', 'Mission/Vision updated.');
    }

    public function destroy(AboutMissionVision $missionVision): RedirectResponse
    {
        $missionVision->delete();

        return redirect()
            ->route('admin.about.mission-visions.index')
            ->with('status', 'Mission/Vision deleted.');
    }

    public function toggle(Request $request, AboutMissionVision $missionVision): JsonResponse|RedirectResponse
    {
        $missionVision->update(['is_active' => ! $missionVision->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $missionVision->is_active]);
        }

        return redirect()
            ->route('admin.about.mission-visions.index')
            ->with('status', 'Mission/Vision visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AboutMissionVision::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.about.mission-visions.index')
            ->with('status', 'Mission/Vision order updated.');
    }

    private function validateMissionVision(Request $request): array
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:mission,vision'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
