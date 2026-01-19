<?php

namespace App\Http\Controllers;

use App\Models\LandingEventItem;
use App\Models\LandingHero;
use App\Models\LandingNewsItem;
use App\Models\LandingProgram;
use App\Models\LandingSection;
use App\Models\LandingStat;
use App\Models\LandingStudentLifeItem;
use App\Models\LandingTestimonial;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        $sections = LandingSection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('key');

        $hero = LandingHero::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $stats = LandingStat::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $programs = LandingProgram::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $featuredProgram = $programs->firstWhere('is_featured', true) ?? $programs->first();
        $otherPrograms = $featuredProgram ? $programs->reject(fn ($program) => $program->id === $featuredProgram->id) : collect();

        $studentLifeItems = LandingStudentLifeItem::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $testimonials = LandingTestimonial::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $newsItems = LandingNewsItem::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->get();

        $eventItems = LandingEventItem::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('college.index', compact(
            'sections',
            'hero',
            'stats',
            'featuredProgram',
            'otherPrograms',
            'studentLifeItems',
            'testimonials',
            'newsItems',
            'eventItems'
        ));
    }
}
