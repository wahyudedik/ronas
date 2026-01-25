<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollegeNewsController extends Controller
{
    public function index(Request $request): View
    {
        $query = News::published()->with(['category', 'author']);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->paginate(12);

        $categories = NewsCategory::all();

        return view('college.news', compact('news', 'categories'));
    }

    public function show(News $news): View
    {
        if ($news->status !== 'published' || !$news->is_active) {
            abort(404);
        }

        $relatedNews = News::published()
            ->where('id', '!=', $news->id)
            ->where('category_id', $news->category_id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $categories = NewsCategory::all();

        return view('college.news-details', compact('news', 'relatedNews', 'categories'));
    }
}
