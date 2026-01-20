<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicsFacultyHighlight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AcademicsFacultyHighlightController extends Controller
{
    public function index(): View
    {
        $highlights = AcademicsFacultyHighlight::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.academics.faculty-highlights.index', compact('highlights'));
    }

    public function create(): View
    {
        return view('admin.academics.faculty-highlights.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateHighlight($request);
        $this->handleImageUpload($request, $validated);
        AcademicsFacultyHighlight::create($validated);

        return redirect()
            ->route('admin.academics.faculty-highlights.index')
            ->with('status', 'Faculty highlight saved.');
    }

    public function edit(AcademicsFacultyHighlight $facultyHighlight): View
    {
        return view('admin.academics.faculty-highlights.edit', compact('facultyHighlight'));
    }

    public function update(Request $request, AcademicsFacultyHighlight $facultyHighlight): RedirectResponse
    {
        $validated = $this->validateHighlight($request);
        $this->handleImageUpload($request, $validated, $facultyHighlight->image);
        $facultyHighlight->update($validated);

        return redirect()
            ->route('admin.academics.faculty-highlights.index')
            ->with('status', 'Faculty highlight updated.');
    }

    public function destroy(AcademicsFacultyHighlight $facultyHighlight): RedirectResponse
    {
        $this->deleteOldImage($facultyHighlight->image);
        $facultyHighlight->delete();

        return redirect()
            ->route('admin.academics.faculty-highlights.index')
            ->with('status', 'Faculty highlight deleted.');
    }

    public function toggle(Request $request, AcademicsFacultyHighlight $facultyHighlight): JsonResponse|RedirectResponse
    {
        $facultyHighlight->update(['is_active' => ! $facultyHighlight->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $facultyHighlight->is_active]);
        }

        return redirect()
            ->route('admin.academics.faculty-highlights.index')
            ->with('status', 'Faculty highlight visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AcademicsFacultyHighlight::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.academics.faculty-highlights.index')
            ->with('status', 'Faculty highlight order updated.');
    }

    private function validateHighlight(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'twitter_url' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('academics', 'public');
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
