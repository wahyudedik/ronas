<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionsCampusVisitSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdmissionsCampusVisitSettingController extends Controller
{
    public function index(): View
    {
        $settings = AdmissionsCampusVisitSetting::query()->orderByDesc('id')->paginate(10);

        return view('admin.admissions.campus-visit-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('admin.admissions.campus-visit-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSetting($request);
        $this->handleImageUpload($request, $validated);

        AdmissionsCampusVisitSetting::create($validated);

        return redirect()
            ->route('admin.admissions.campus-visit-settings.index')
            ->with('status', 'Campus visit setting saved.');
    }

    public function edit(AdmissionsCampusVisitSetting $campusVisitSetting): View
    {
        return view('admin.admissions.campus-visit-settings.edit', compact('campusVisitSetting'));
    }

    public function update(Request $request, AdmissionsCampusVisitSetting $campusVisitSetting): RedirectResponse
    {
        $validated = $this->validateSetting($request);
        $this->handleImageUpload($request, $validated, $campusVisitSetting->image);

        $campusVisitSetting->update($validated);

        return redirect()
            ->route('admin.admissions.campus-visit-settings.index')
            ->with('status', 'Campus visit setting updated.');
    }

    private function validateSetting(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_caption' => ['nullable', 'string', 'max:255'],
            'button_label' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'virtual_label' => ['nullable', 'string', 'max:255'],
            'virtual_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('admissions', 'public');
            $validated['image'] = 'storage/' . $path;
            $this->deleteOldImage($existingImage);
        }
    }

    private function deleteOldImage(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'storage/')) {
            return;
        }

        $relative = substr($path, strlen('storage/'));
        if ($relative !== '') {
            Storage::disk('public')->delete($relative);
        }
    }
}
