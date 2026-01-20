<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusVirtualTour;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusVirtualTourController extends Controller
{
    public function index(): View
    {
        $tours = CampusVirtualTour::query()
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.facilities.virtual-tours.index', compact('tours'));
    }

    public function create(): View
    {
        return view('admin.facilities.virtual-tours.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTour($request);
        CampusVirtualTour::create($validated);

        return redirect()
            ->route('admin.facilities.virtual-tours.index')
            ->with('status', 'Virtual tour saved.');
    }

    public function edit(CampusVirtualTour $virtualTour): View
    {
        return view('admin.facilities.virtual-tours.edit', compact('virtualTour'));
    }

    public function update(Request $request, CampusVirtualTour $virtualTour): RedirectResponse
    {
        $validated = $this->validateTour($request);
        $virtualTour->update($validated);

        return redirect()
            ->route('admin.facilities.virtual-tours.index')
            ->with('status', 'Virtual tour updated.');
    }

    public function toggle(Request $request, CampusVirtualTour $virtualTour): JsonResponse|RedirectResponse
    {
        $virtualTour->update(['is_active' => ! $virtualTour->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $virtualTour->is_active]);
        }

        return redirect()
            ->route('admin.facilities.virtual-tours.index')
            ->with('status', 'Virtual tour visibility updated.');
    }

    private function validateTour(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'primary_label' => ['nullable', 'string', 'max:100'],
            'primary_url' => ['nullable', 'string', 'max:255'],
            'secondary_label' => ['nullable', 'string', 'max:100'],
            'secondary_url' => ['nullable', 'string', 'max:255'],
            'video_url' => ['nullable', 'string', 'max:255'],
            'badge_text' => ['nullable', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
