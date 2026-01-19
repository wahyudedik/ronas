<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsCampusVisitOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsCampusVisitOptionController extends Controller
{
    public function index(): View
    {
        $options = AdmissionsCampusVisitOption::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.admissions.campus-visit-options.index', compact('options'));
    }

    public function create(): View
    {
        return view('admin.admissions.campus-visit-options.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateOption($request);

        AdmissionsCampusVisitOption::create($validated);

        return redirect()
            ->route('admin.admissions.campus-visit-options.index')
            ->with('status', 'Campus visit option saved.');
    }

    public function edit(AdmissionsCampusVisitOption $campusVisitOption): View
    {
        return view('admin.admissions.campus-visit-options.edit', compact('campusVisitOption'));
    }

    public function update(Request $request, AdmissionsCampusVisitOption $campusVisitOption): RedirectResponse
    {
        $validated = $this->validateOption($request);

        $campusVisitOption->update($validated);

        return redirect()
            ->route('admin.admissions.campus-visit-options.index')
            ->with('status', 'Campus visit option updated.');
    }

    public function destroy(AdmissionsCampusVisitOption $campusVisitOption): RedirectResponse
    {
        $campusVisitOption->delete();

        return redirect()
            ->route('admin.admissions.campus-visit-options.index')
            ->with('status', 'Campus visit option deleted.');
    }

    public function toggle(Request $request, AdmissionsCampusVisitOption $campusVisitOption): JsonResponse|RedirectResponse
    {
        $campusVisitOption->update(['is_active' => ! $campusVisitOption->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $campusVisitOption->is_active]);
        }

        return redirect()
            ->route('admin.admissions.campus-visit-options.index')
            ->with('status', 'Campus visit option visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AdmissionsCampusVisitOption::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.admissions.campus-visit-options.index')
            ->with('status', 'Campus visit option order updated.');
    }

    private function validateOption(Request $request): array
    {
        $validated = $request->validate([
            'icon_class' => ['nullable', 'string', 'max:100'],
            'text' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
