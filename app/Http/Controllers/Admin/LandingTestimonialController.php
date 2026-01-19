<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingTestimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LandingTestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = LandingTestimonial::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.landing.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.landing.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTestimonial($request);
        $this->handleImageUpload($request, $validated);
        LandingTestimonial::create($validated);

        return redirect()
            ->route('admin.landing.testimonials.index')
            ->with('status', 'Testimonial saved.');
    }

    public function edit(LandingTestimonial $testimonial): View
    {
        return view('admin.landing.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, LandingTestimonial $testimonial): RedirectResponse
    {
        $validated = $this->validateTestimonial($request);
        $this->handleImageUpload($request, $validated, $testimonial->image);
        $testimonial->update($validated);

        return redirect()
            ->route('admin.landing.testimonials.index')
            ->with('status', 'Testimonial updated.');
    }

    public function destroy(LandingTestimonial $testimonial): RedirectResponse
    {
        $this->deleteOldImage($testimonial->image);
        $testimonial->delete();

        return redirect()
            ->route('admin.landing.testimonials.index')
            ->with('status', 'Testimonial deleted.');
    }

    public function toggle(Request $request, LandingTestimonial $testimonial): JsonResponse|RedirectResponse
    {
        $testimonial->update(['is_active' => ! $testimonial->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $testimonial->is_active]);
        }

        return redirect()
            ->route('admin.landing.testimonials.index')
            ->with('status', 'Testimonial visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingTestimonial::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.testimonials.index')
            ->with('status', 'Testimonial order updated.');
    }

    private function validateTestimonial(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'quote' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['rating'] = $validated['rating'] ?? 5;
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
