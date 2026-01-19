<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsDeadlineSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsDeadlineSettingController extends Controller
{
    public function index(): View
    {
        $settings = AdmissionsDeadlineSetting::query()->orderByDesc('id')->paginate(10);

        return view('admin.admissions.deadline-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('admin.admissions.deadline-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        AdmissionsDeadlineSetting::create($validated);

        return redirect()
            ->route('admin.admissions.deadline-settings.index')
            ->with('status', 'Deadline setting saved.');
    }

    public function edit(AdmissionsDeadlineSetting $deadlineSetting): View
    {
        return view('admin.admissions.deadline-settings.edit', compact('deadlineSetting'));
    }

    public function update(Request $request, AdmissionsDeadlineSetting $deadlineSetting): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        $deadlineSetting->update($validated);

        return redirect()
            ->route('admin.admissions.deadline-settings.index')
            ->with('status', 'Deadline setting updated.');
    }

    private function validateSetting(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
