<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsRequirementSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsRequirementSettingController extends Controller
{
    public function index(): View
    {
        $settings = AdmissionsRequirementSetting::query()->orderByDesc('id')->paginate(10);

        return view('admin.admissions.requirement-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('admin.admissions.requirement-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        AdmissionsRequirementSetting::create($validated);

        return redirect()
            ->route('admin.admissions.requirement-settings.index')
            ->with('status', 'Requirement setting saved.');
    }

    public function edit(AdmissionsRequirementSetting $requirementSetting): View
    {
        return view('admin.admissions.requirement-settings.edit', compact('requirementSetting'));
    }

    public function update(Request $request, AdmissionsRequirementSetting $requirementSetting): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        $requirementSetting->update($validated);

        return redirect()
            ->route('admin.admissions.requirement-settings.index')
            ->with('status', 'Requirement setting updated.');
    }

    private function validateSetting(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
