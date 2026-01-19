<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHistory;
use App\Models\AboutHistoryMilestone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutHistoryMilestoneController extends Controller
{
    public function index(Request $request): View
    {
        $historyId = $request->query('history_id');

        $milestones = AboutHistoryMilestone::query()
            ->when($historyId, fn ($query) => $query->where('about_history_id', $historyId))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        $histories = AboutHistory::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.about.milestones.index', compact('milestones', 'histories', 'historyId'));
    }

    public function create(Request $request): View
    {
        $histories = AboutHistory::query()->orderBy('sort_order')->orderBy('id')->get();
        $historyId = $request->query('history_id');

        return view('admin.about.milestones.create', compact('histories', 'historyId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateMilestone($request);

        AboutHistoryMilestone::create($validated);

        return redirect()
            ->route('admin.about.milestones.index', ['history_id' => $validated['about_history_id']])
            ->with('status', 'Milestone saved.');
    }

    public function edit(AboutHistoryMilestone $milestone): View
    {
        $histories = AboutHistory::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.about.milestones.edit', compact('milestone', 'histories'));
    }

    public function update(Request $request, AboutHistoryMilestone $milestone): RedirectResponse
    {
        $validated = $this->validateMilestone($request);

        $milestone->update($validated);

        return redirect()
            ->route('admin.about.milestones.index', ['history_id' => $validated['about_history_id']])
            ->with('status', 'Milestone updated.');
    }

    public function destroy(AboutHistoryMilestone $milestone): RedirectResponse
    {
        $historyId = $milestone->about_history_id;
        $milestone->delete();

        return redirect()
            ->route('admin.about.milestones.index', ['history_id' => $historyId])
            ->with('status', 'Milestone deleted.');
    }

    public function toggle(Request $request, AboutHistoryMilestone $milestone): JsonResponse|RedirectResponse
    {
        $milestone->update(['is_active' => ! $milestone->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $milestone->is_active]);
        }

        return redirect()
            ->route('admin.about.milestones.index', ['history_id' => $milestone->about_history_id])
            ->with('status', 'Milestone visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AboutHistoryMilestone::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.about.milestones.index')
            ->with('status', 'Milestone order updated.');
    }

    private function validateMilestone(Request $request): array
    {
        $validated = $request->validate([
            'about_history_id' => ['required', 'exists:about_histories,id'],
            'year' => ['required', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
