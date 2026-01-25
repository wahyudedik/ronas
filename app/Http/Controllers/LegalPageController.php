<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LegalPageController extends Controller
{
    public function show($slug)
    {
        // Try to find a published legal page by slug
        // Cache the result for 60 minutes to improve performance for static pages
        $page = Cache::remember("legal_page_{$slug}", 60, function () use ($slug) {
            return LegalPage::where('slug', $slug)
                ->where('status', 'published')
                ->first();
        });

        if (!$page) {
            abort(404);
        }

        return view('legal.show', compact('page'));
    }
}
