<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsRequestProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsRequestProgramController extends Controller
{
    public function index(): View
    {
        $programs = AdmissionsRequestProgram::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.admissions.request-programs.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin.admissions.request-programs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProgram($request);

        AdmissionsRequestProgram::create($validated);

        return redirect()
            ->route('admin.admissions.request-programs.index')
            ->with('status', 'Program saved.');
    }

    public function edit(AdmissionsRequestProgram $requestProgram): View
    {
        return view('admin.admissions.request-programs.edit', compact('requestProgram'));
    }

    public function update(Request $request, AdmissionsRequestProgram $requestProgram): RedirectResponse
    {
        $validated = $this->validateProgram($request);

        $requestProgram->update($validated);

        return redirect()
            ->route('admin.admissions.request-programs.index')
            ->with('status', 'Program updated.');
    }

    public function destroy(AdmissionsRequestProgram $requestProgram): RedirectResponse
    {
        $requestProgram->delete();

        return redirect()
            ->route('admin.admissions.request-programs.index')
            ->with('status', 'Program deleted.');
    }

    public function toggle(Request $request, AdmissionsRequestProgram $requestProgram): JsonResponse|RedirectResponse
    {
        $requestProgram->update(['is_active' => ! $requestProgram->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $requestProgram->is_active]);
        }

        return redirect()
            ->route('admin.admissions.request-programs.index')
            ->with('status', 'Program visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AdmissionsRequestProgram::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.admissions.request-programs.index')
            ->with('status', 'Program order updated.');
    }

    private function validateProgram(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
