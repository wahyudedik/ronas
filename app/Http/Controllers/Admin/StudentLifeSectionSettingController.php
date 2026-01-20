<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentLifeSectionSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentLifeSectionSettingController extends Controller
{
    public function index(): View
    {
        $sections = StudentLifeSectionSetting::query()
            ->orderBy('id')
            ->get()
            ->keyBy('key');

        return view('admin.landing.student-life-sections.index', compact('sections'));
    }

    public function update(Request $request, string $key): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        StudentLifeSectionSetting::query()
            ->where('key', $key)
            ->update($validated);

        return redirect()
            ->route('admin.landing.student-life-sections.index')
            ->with('status', 'Section updated.');
    }
}
