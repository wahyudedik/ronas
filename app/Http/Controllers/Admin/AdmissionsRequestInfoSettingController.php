<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsRequestInfoSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsRequestInfoSettingController extends Controller
{
    public function index(): View
    {
        $settings = AdmissionsRequestInfoSetting::query()->orderByDesc('id')->paginate(10);

        return view('admin.admissions.request-info-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('admin.admissions.request-info-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        AdmissionsRequestInfoSetting::create($validated);

        return redirect()
            ->route('admin.admissions.request-info-settings.index')
            ->with('status', 'Request info setting saved.');
    }

    public function edit(AdmissionsRequestInfoSetting $requestInfoSetting): View
    {
        return view('admin.admissions.request-info-settings.edit', compact('requestInfoSetting'));
    }

    public function update(Request $request, AdmissionsRequestInfoSetting $requestInfoSetting): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        $requestInfoSetting->update($validated);

        return redirect()
            ->route('admin.admissions.request-info-settings.index')
            ->with('status', 'Request info setting updated.');
    }

    private function validateSetting(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'form_action' => ['nullable', 'string', 'max:255'],
            'submit_label' => ['nullable', 'string', 'max:255'],
            'program_placeholder' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
