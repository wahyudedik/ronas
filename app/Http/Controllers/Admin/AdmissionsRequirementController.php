<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsRequirement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsRequirementController extends Controller
{
    public function index(): View
    {
        $requirements = AdmissionsRequirement::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.admissions.requirements.index', compact('requirements'));
    }

    public function create(): View
    {
        return view('admin.admissions.requirements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequirement($request);

        AdmissionsRequirement::create($validated);

        return redirect()
            ->route('admin.admissions.requirements.index')
            ->with('status', 'Requirement saved.');
    }

    public function edit(AdmissionsRequirement $requirement): View
    {
        return view('admin.admissions.requirements.edit', compact('requirement'));
    }

    public function update(Request $request, AdmissionsRequirement $requirement): RedirectResponse
    {
        $validated = $this->validateRequirement($request);

        $requirement->update($validated);

        return redirect()
            ->route('admin.admissions.requirements.index')
            ->with('status', 'Requirement updated.');
    }

    public function destroy(AdmissionsRequirement $requirement): RedirectResponse
    {
        $requirement->delete();

        return redirect()
            ->route('admin.admissions.requirements.index')
            ->with('status', 'Requirement deleted.');
    }

    public function toggle(Request $request, AdmissionsRequirement $requirement): JsonResponse|RedirectResponse
    {
        $requirement->update(['is_active' => ! $requirement->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $requirement->is_active]);
        }

        return redirect()
            ->route('admin.admissions.requirements.index')
            ->with('status', 'Requirement visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AdmissionsRequirement::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.admissions.requirements.index')
            ->with('status', 'Requirement order updated.');
    }

    private function validateRequirement(Request $request): array
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
