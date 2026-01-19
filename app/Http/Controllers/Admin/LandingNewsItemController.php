<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingNewsItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LandingNewsItemController extends Controller
{
    public function index(): View
    {
        $news = LandingNewsItem::query()
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->paginate(15);

        return view('admin.landing.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.landing.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateNews($request);
        $this->handleImageUpload($request, $validated);
        LandingNewsItem::create($validated);

        return redirect()
            ->route('admin.landing.news.index')
            ->with('status', 'News item saved.');
    }

    public function edit(LandingNewsItem $news): View
    {
        return view('admin.landing.news.edit', ['newsItem' => $news]);
    }

    public function update(Request $request, LandingNewsItem $news): RedirectResponse
    {
        $validated = $this->validateNews($request);
        $this->handleImageUpload($request, $validated, $news->image, $news->author_image);
        $news->update($validated);

        return redirect()
            ->route('admin.landing.news.index')
            ->with('status', 'News item updated.');
    }

    public function destroy(LandingNewsItem $news): RedirectResponse
    {
        $this->deleteOldImage($news->image);
        $this->deleteOldImage($news->author_image);
        $news->delete();

        return redirect()
            ->route('admin.landing.news.index')
            ->with('status', 'News item deleted.');
    }

    public function toggle(Request $request, LandingNewsItem $news): JsonResponse|RedirectResponse
    {
        $news->update(['is_active' => ! $news->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $news->is_active]);
        }

        return redirect()
            ->route('admin.landing.news.index')
            ->with('status', 'News visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            LandingNewsItem::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.landing.news.index')
            ->with('status', 'News order updated.');
    }

    private function validateNews(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'author_image' => ['nullable', 'image', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }

    private function handleImageUpload(
        Request $request,
        array &$validated,
        ?string $existingImage = null,
        ?string $existingAuthorImage = null
    ): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('landing', 'public');
            $validated['image'] = 'storage/' . $path;
            $this->deleteOldImage($existingImage);
        }

        if ($request->hasFile('author_image')) {
            $path = $request->file('author_image')->store('landing', 'public');
            $validated['author_image'] = 'storage/' . $path;
            $this->deleteOldImage($existingAuthorImage);
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
