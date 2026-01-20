<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class CollegeNewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->paginate(12);

        return view('college.news', compact('news'));
    }

    public function show(News $news): View
    {
        if (!$news->is_active) {
            abort(404);
        }

        $relatedNews = News::query()
            ->where('is_active', true)
            ->where('id', '!=', $news->id)
            ->where('category', $news->category)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('college.news-details', compact('news', 'relatedNews'));
    }
}
