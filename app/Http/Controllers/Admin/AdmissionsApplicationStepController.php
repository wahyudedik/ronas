<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsApplicationStep;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsApplicationStepController extends Controller
{
    public function index(): View
    {
        $steps = AdmissionsApplicationStep::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.admissions.application-steps.index', compact('steps'));
    }

    public function create(): View
    {
        return view('admin.admissions.application-steps.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateStep($request);

        AdmissionsApplicationStep::create($validated);

        return redirect()
            ->route('admin.admissions.application-steps.index')
            ->with('status', 'Step saved.');
    }

    public function edit(AdmissionsApplicationStep $applicationStep): View
    {
        return view('admin.admissions.application-steps.edit', compact('applicationStep'));
    }

    public function update(Request $request, AdmissionsApplicationStep $applicationStep): RedirectResponse
    {
        $validated = $this->validateStep($request);

        $applicationStep->update($validated);

        return redirect()
            ->route('admin.admissions.application-steps.index')
            ->with('status', 'Step updated.');
    }

    public function destroy(AdmissionsApplicationStep $applicationStep): RedirectResponse
    {
        $applicationStep->delete();

        return redirect()
            ->route('admin.admissions.application-steps.index')
            ->with('status', 'Step deleted.');
    }

    public function toggle(Request $request, AdmissionsApplicationStep $applicationStep): JsonResponse|RedirectResponse
    {
        $applicationStep->update(['is_active' => ! $applicationStep->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $applicationStep->is_active]);
        }

        return redirect()
            ->route('admin.admissions.application-steps.index')
            ->with('status', 'Step visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AdmissionsApplicationStep::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.admissions.application-steps.index')
            ->with('status', 'Step order updated.');
    }

    private function validateStep(Request $request): array
    {
        $validated = $request->validate([
            'step_number' => ['nullable', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
