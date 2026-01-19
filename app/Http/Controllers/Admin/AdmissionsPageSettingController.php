<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionsPageSettingController extends Controller
{
    public function index(): View
    {
        $settings = AdmissionsPageSetting::query()->orderByDesc('id')->paginate(10);

        return view('admin.admissions.page-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('admin.admissions.page-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        AdmissionsPageSetting::create($validated);

        return redirect()
            ->route('admin.admissions.page-settings.index')
            ->with('status', 'Page setting saved.');
    }

    public function edit(AdmissionsPageSetting $pageSetting): View
    {
        return view('admin.admissions.page-settings.edit', compact('pageSetting'));
    }

    public function update(Request $request, AdmissionsPageSetting $pageSetting): RedirectResponse
    {
        $validated = $this->validateSetting($request);

        $pageSetting->update($validated);

        return redirect()
            ->route('admin.admissions.page-settings.index')
            ->with('status', 'Page setting updated.');
    }

    private function validateSetting(Request $request): array
    {
        $validated = $request->validate([
            'page_title' => ['nullable', 'string', 'max:255'],
            'breadcrumb_title' => ['nullable', 'string', 'max:255'],
            'steps_title' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
