<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingSectionController extends Controller
{
    public function index(): View
    {
        $sections = LandingSection::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.landing.sections.index', compact('sections'));
    }

    public function create(): View
    {
        return view('admin.landing.sections.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'key' => ['required', 'string', 'max:100', 'unique:landing_sections,key'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        LandingSection::create($validated);

        return redirect()
            ->route('admin.landing.sections.index')
            ->with('status', 'Section saved.');
    }

    public function edit(LandingSection $section): View
    {
        return view('admin.landing.sections.edit', compact('section'));
    }

    public function update(Request $request, LandingSection $section): RedirectResponse
    {
        $validated = $request->validate([
            'key' => ['required', 'string', 'max:100', 'unique:landing_sections,key,' . $section->id],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        $section->update($validated);

        return redirect()
            ->route('admin.landing.sections.index')
            ->with('status', 'Section updated.');
    }

    public function destroy(LandingSection $section): RedirectResponse
    {
        $section->delete();

        return redirect()
            ->route('admin.landing.sections.index')
            ->with('status', 'Section deleted.');
    }

    public function toggle(Request $request, LandingSection $section): JsonResponse|RedirectResponse
    {
        $section->update(['is_active' => ! $section->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $section->is_active]);
        }

        return redirect()
            ->route('admin.landing.sections.index')
            ->with('status', 'Section visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingSection::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.sections.index')
            ->with('status', 'Section order updated.');
    }
}
