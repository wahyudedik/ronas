<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsTuitionSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsTuitionSettingController extends Controller
{
    public function index(): View
    {
        $settings = AdmissionsTuitionSetting::query()->orderByDesc('id')->paginate(10);

        return view('admin.admissions.tuition-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('admin.admissions.tuition-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        AdmissionsTuitionSetting::create($validated);

        return redirect()
            ->route('admin.admissions.tuition-settings.index')
            ->with('status', 'Tuition setting saved.');
    }

    public function edit(AdmissionsTuitionSetting $tuitionSetting): View
    {
        return view('admin.admissions.tuition-settings.edit', compact('tuitionSetting'));
    }

    public function update(Request $request, AdmissionsTuitionSetting $tuitionSetting): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        $tuitionSetting->update($validated);

        return redirect()
            ->route('admin.admissions.tuition-settings.index')
            ->with('status', 'Tuition setting updated.');
    }

    private function validateSetting(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'aid_title' => ['nullable', 'string', 'max:255'],
            'aid_description' => ['nullable', 'string'],
            'aid_button_label' => ['nullable', 'string', 'max:255'],
            'aid_button_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
