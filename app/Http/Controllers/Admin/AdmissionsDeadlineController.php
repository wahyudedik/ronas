<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsDeadline;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsDeadlineController extends Controller
{
    public function index(): View
    {
        $deadlines = AdmissionsDeadline::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.admissions.deadlines.index', compact('deadlines'));
    }

    public function create(): View
    {
        return view('admin.admissions.deadlines.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateDeadline($request);

        AdmissionsDeadline::create($validated);

        return redirect()
            ->route('admin.admissions.deadlines.index')
            ->with('status', 'Deadline saved.');
    }

    public function edit(AdmissionsDeadline $deadline): View
    {
        return view('admin.admissions.deadlines.edit', compact('deadline'));
    }

    public function update(Request $request, AdmissionsDeadline $deadline): RedirectResponse
    {
        $validated = $this->validateDeadline($request);

        $deadline->update($validated);

        return redirect()
            ->route('admin.admissions.deadlines.index')
            ->with('status', 'Deadline updated.');
    }

    public function destroy(AdmissionsDeadline $deadline): RedirectResponse
    {
        $deadline->delete();

        return redirect()
            ->route('admin.admissions.deadlines.index')
            ->with('status', 'Deadline deleted.');
    }

    public function toggle(Request $request, AdmissionsDeadline $deadline): JsonResponse|RedirectResponse
    {
        $deadline->update(['is_active' => ! $deadline->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $deadline->is_active]);
        }

        return redirect()
            ->route('admin.admissions.deadlines.index')
            ->with('status', 'Deadline visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AdmissionsDeadline::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.admissions.deadlines.index')
            ->with('status', 'Deadline order updated.');
    }

    private function validateDeadline(Request $request): array
    {
        $validated = $request->validate([
            'date_text' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
