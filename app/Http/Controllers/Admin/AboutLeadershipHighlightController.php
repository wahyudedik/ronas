<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutLeadershipHighlight;
use App\Models\AboutLeadershipSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutLeadershipHighlightController extends Controller
{
    public function index(Request $request): View
    {
        $sectionId = $request->query('section_id');

        $highlights = AboutLeadershipHighlight::query()
            ->when($sectionId, fn ($query) => $query->where('about_leadership_section_id', $sectionId))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        $sections = AboutLeadershipSection::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.about.leadership-highlights.index', compact('highlights', 'sections', 'sectionId'));
    }

    public function create(Request $request): View
    {
        $sections = AboutLeadershipSection::query()->orderBy('sort_order')->orderBy('id')->get();
        $sectionId = $request->query('section_id');

        return view('admin.about.leadership-highlights.create', compact('sections', 'sectionId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateHighlight($request);

        AboutLeadershipHighlight::create($validated);

        return redirect()
            ->route('admin.about.leadership-highlights.index', ['section_id' => $validated['about_leadership_section_id']])
            ->with('status', 'Leadership highlight saved.');
    }

    public function edit(AboutLeadershipHighlight $leadershipHighlight): View
    {
        $sections = AboutLeadershipSection::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.about.leadership-highlights.edit', compact('leadershipHighlight', 'sections'));
    }

    public function update(Request $request, AboutLeadershipHighlight $leadershipHighlight): RedirectResponse
    {
        $validated = $this->validateHighlight($request);

        $leadershipHighlight->update($validated);

        return redirect()
            ->route('admin.about.leadership-highlights.index', ['section_id' => $validated['about_leadership_section_id']])
            ->with('status', 'Leadership highlight updated.');
    }

    public function destroy(AboutLeadershipHighlight $leadershipHighlight): RedirectResponse
    {
        $sectionId = $leadershipHighlight->about_leadership_section_id;
        $leadershipHighlight->delete();

        return redirect()
            ->route('admin.about.leadership-highlights.index', ['section_id' => $sectionId])
            ->with('status', 'Leadership highlight deleted.');
    }

    public function toggle(Request $request, AboutLeadershipHighlight $leadershipHighlight): JsonResponse|RedirectResponse
    {
        $leadershipHighlight->update(['is_active' => ! $leadershipHighlight->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $leadershipHighlight->is_active]);
        }

        return redirect()
            ->route('admin.about.leadership-highlights.index', ['section_id' => $leadershipHighlight->about_leadership_section_id])
            ->with('status', 'Leadership highlight visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AboutLeadershipHighlight::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.about.leadership-highlights.index')
            ->with('status', 'Leadership highlight order updated.');
    }

    private function validateHighlight(Request $request): array
    {
        $validated = $request->validate([
            'about_leadership_section_id' => ['required', 'exists:about_leadership_sections,id'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
