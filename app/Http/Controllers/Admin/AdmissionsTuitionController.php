<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsTuition;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsTuitionController extends Controller
{
    public function index(): View
    {
        $tuitions = AdmissionsTuition::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.admissions.tuitions.index', compact('tuitions'));
    }

    public function create(): View
    {
        return view('admin.admissions.tuitions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTuition($request);

        AdmissionsTuition::create($validated);

        return redirect()
            ->route('admin.admissions.tuitions.index')
            ->with('status', 'Tuition saved.');
    }

    public function edit(AdmissionsTuition $tuition): View
    {
        return view('admin.admissions.tuitions.edit', compact('tuition'));
    }

    public function update(Request $request, AdmissionsTuition $tuition): RedirectResponse
    {
        $validated = $this->validateTuition($request);

        $tuition->update($validated);

        return redirect()
            ->route('admin.admissions.tuitions.index')
            ->with('status', 'Tuition updated.');
    }

    public function destroy(AdmissionsTuition $tuition): RedirectResponse
    {
        $tuition->delete();

        return redirect()
            ->route('admin.admissions.tuitions.index')
            ->with('status', 'Tuition deleted.');
    }

    public function toggle(Request $request, AdmissionsTuition $tuition): JsonResponse|RedirectResponse
    {
        $tuition->update(['is_active' => ! $tuition->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $tuition->is_active]);
        }

        return redirect()
            ->route('admin.admissions.tuitions.index')
            ->with('status', 'Tuition visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AdmissionsTuition::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.admissions.tuitions.index')
            ->with('status', 'Tuition order updated.');
    }

    private function validateTuition(Request $request): array
    {
        $validated = $request->validate([
            'program' => ['required', 'string', 'max:255'],
            'tuition' => ['nullable', 'string', 'max:100'],
            'fees' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
