<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::with(['category', 'author'])
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateNews($request);
        $this->handleImageUpload($request, $validated);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['author_id'] = Auth::id();

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'News saved.');
    }

    public function edit(News $news): View
    {
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $this->validateNews($request);
        $this->handleImageUpload($request, $validated, $news->image, $news->author_image);

        // Generate slug if title changed and slug not provided
        if ($news->title !== $validated['title'] && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'News updated.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $this->deleteOldImage($news->image);
        $this->deleteOldImage($news->author_image);
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'News deleted.');
    }

    private function validateNews(Request $request): array
    {
        $newsId = $request->route('news')?->id ?? null;
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:news,slug,' . $newsId],
            'category_id' => ['nullable', 'exists:news_categories,id'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'author_image' => ['nullable', 'image', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'status' => ['required', 'in:draft,published,archived'],
            'meta_keywords' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }

    private function handleImageUpload(
        Request $request,
        array &$validated,
        ?string $existingImage = null,
        ?string $existingAuthorImage = null
    ): void {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $validated['image'] = 'storage/' . $path;
            $this->deleteOldImage($existingImage);
        }

        if ($request->hasFile('author_image')) {
            $path = $request->file('author_image')->store('news', 'public');
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
