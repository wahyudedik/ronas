<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LandingProgramController extends Controller
{
    public function index(): View
    {
        $programs = LandingProgram::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.landing.programs.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin.landing.programs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProgram($request);
        $this->handleImageUpload($request, $validated);
        LandingProgram::create($validated);

        return redirect()
            ->route('admin.landing.programs.index')
            ->with('status', 'Program saved.');
    }

    public function edit(LandingProgram $program): View
    {
        return view('admin.landing.programs.edit', compact('program'));
    }

    public function update(Request $request, LandingProgram $program): RedirectResponse
    {
        $validated = $this->validateProgram($request);
        $this->handleImageUpload($request, $validated, $program->image);
        $program->update($validated);

        return redirect()
            ->route('admin.landing.programs.index')
            ->with('status', 'Program updated.');
    }

    public function destroy(LandingProgram $program): RedirectResponse
    {
        $this->deleteOldImage($program->image);
        $program->delete();

        return redirect()
            ->route('admin.landing.programs.index')
            ->with('status', 'Program deleted.');
    }

    public function toggle(Request $request, LandingProgram $program): JsonResponse|RedirectResponse
    {
        $program->update(['is_active' => ! $program->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $program->is_active]);
        }

        return redirect()
            ->route('admin.landing.programs.index')
            ->with('status', 'Program visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingProgram::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.programs.index')
            ->with('status', 'Program order updated.');
    }

    private function validateProgram(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration_text' => ['nullable', 'string', 'max:100'],
            'degree_text' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:2048'],
            'badge_text' => ['nullable', 'string', 'max:50'],
            'meta_one' => ['nullable', 'string', 'max:100'],
            'meta_two' => ['nullable', 'string', 'max:100'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_featured'] = (bool) ($validated['is_featured'] ?? false);
        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('landing', 'public');
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
