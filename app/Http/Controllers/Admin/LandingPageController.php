<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingEvent;
use App\Models\LandingHero;
use App\Models\LandingNewsItem;
use App\Models\LandingProgram;
use App\Models\LandingSectionSetting;
use App\Models\LandingStat;
use App\Models\LandingStudentLifeItem;
use App\Models\LandingTestimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        return view('admin.landing.index');
    }

    public function hero(): View
    {
        $hero = LandingHero::query()->first() ?? new LandingHero(['is_active' => true]);

        return view('admin.landing.hero', compact('hero'));
    }

    public function updateHero(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'badge_text' => ['nullable', 'string', 'max:255'],
            'badge_icon' => ['nullable', 'string', 'max:255'],
            'primary_cta_text' => ['nullable', 'string', 'max:255'],
            'primary_cta_url' => ['nullable', 'string', 'max:255'],
            'secondary_cta_text' => ['nullable', 'string', 'max:255'],
            'secondary_cta_url' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        $hero = LandingHero::query()->first();
        if ($hero) {
            $hero->update($validated);
        } else {
            LandingHero::create($validated);
        }

        return back()->with('status', 'Hero updated.');
    }

    public function updateSectionSetting(Request $request, string $key): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        LandingSectionSetting::updateOrCreate(
            ['key' => $key],
            $validated
        );

        return back()->with('status', 'Section updated.');
    }

    public function statsIndex(): View
    {
        $stats = LandingStat::query()->orderBy('sort_order')->get();
        $setting = LandingSectionSetting::firstOrNew(['key' => 'stats']);

        return view('admin.landing.stats.index', compact('stats', 'setting'));
    }

    public function statsCreate(): View
    {
        return view('admin.landing.stats.create');
    }

    public function statsStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        LandingStat::create([
            'label' => $validated['label'],
            'value' => $validated['value'],
            'suffix' => $validated['suffix'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.stats.index')->with('status', 'Stat added.');
    }

    public function statsEdit(LandingStat $stat): View
    {
        return view('admin.landing.stats.edit', compact('stat'));
    }

    public function statsUpdate(Request $request, LandingStat $stat): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $stat->update([
            'label' => $validated['label'],
            'value' => $validated['value'],
            'suffix' => $validated['suffix'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.stats.index')->with('status', 'Stat updated.');
    }

    public function statsDestroy(LandingStat $stat): RedirectResponse
    {
        $stat->delete();

        return redirect()->route('admin.landing.stats.index')->with('status', 'Stat deleted.');
    }

    public function programsIndex(): View
    {
        $programs = LandingProgram::query()->orderBy('sort_order')->get();
        $setting = LandingSectionSetting::firstOrNew(['key' => 'programs']);

        return view('admin.landing.programs.index', compact('programs', 'setting'));
    }

    public function programsCreate(): View
    {
        return view('admin.landing.programs.create');
    }

    public function programsStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'badge_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        LandingProgram::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'duration' => $validated['duration'] ?? null,
            'level' => $validated['level'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'badge_text' => $validated['badge_text'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.programs.index')->with('status', 'Program added.');
    }

    public function programsEdit(LandingProgram $program): View
    {
        return view('admin.landing.programs.edit', compact('program'));
    }

    public function programsUpdate(Request $request, LandingProgram $program): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'badge_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $program->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'duration' => $validated['duration'] ?? null,
            'level' => $validated['level'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'badge_text' => $validated['badge_text'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.programs.index')->with('status', 'Program updated.');
    }

    public function programsDestroy(LandingProgram $program): RedirectResponse
    {
        $program->delete();

        return redirect()->route('admin.landing.programs.index')->with('status', 'Program deleted.');
    }

    public function studentLifeIndex(): View
    {
        $items = LandingStudentLifeItem::query()->orderBy('sort_order')->get();
        $setting = LandingSectionSetting::firstOrNew(['key' => 'student_life']);

        return view('admin.landing.student-life.index', compact('items', 'setting'));
    }

    public function studentLifeCreate(): View
    {
        return view('admin.landing.student-life.create');
    }

    public function studentLifeStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        LandingStudentLifeItem::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'cta_text' => $validated['cta_text'] ?? null,
            'cta_url' => $validated['cta_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.student-life.index')->with('status', 'Item added.');
    }

    public function studentLifeEdit(LandingStudentLifeItem $item): View
    {
        return view('admin.landing.student-life.edit', compact('item'));
    }

    public function studentLifeUpdate(Request $request, LandingStudentLifeItem $item): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $item->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'cta_text' => $validated['cta_text'] ?? null,
            'cta_url' => $validated['cta_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.student-life.index')->with('status', 'Item updated.');
    }

    public function studentLifeDestroy(LandingStudentLifeItem $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.landing.student-life.index')->with('status', 'Item deleted.');
    }

    public function testimonialsIndex(): View
    {
        $testimonials = LandingTestimonial::query()->orderBy('sort_order')->get();
        $setting = LandingSectionSetting::firstOrNew(['key' => 'testimonials']);

        return view('admin.landing.testimonials.index', compact('testimonials', 'setting'));
    }

    public function testimonialsCreate(): View
    {
        return view('admin.landing.testimonials.create');
    }

    public function testimonialsStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'quote' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        LandingTestimonial::create([
            'name' => $validated['name'],
            'role' => $validated['role'] ?? null,
            'quote' => $validated['quote'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'rating' => $validated['rating'] ?? 5,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.testimonials.index')->with('status', 'Testimonial added.');
    }

    public function testimonialsEdit(LandingTestimonial $testimonial): View
    {
        return view('admin.landing.testimonials.edit', compact('testimonial'));
    }

    public function testimonialsUpdate(Request $request, LandingTestimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'quote' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $testimonial->update([
            'name' => $validated['name'],
            'role' => $validated['role'] ?? null,
            'quote' => $validated['quote'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'rating' => $validated['rating'] ?? 5,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.testimonials.index')->with('status', 'Testimonial updated.');
    }

    public function testimonialsDestroy(LandingTestimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()->route('admin.landing.testimonials.index')->with('status', 'Testimonial deleted.');
    }

    public function newsIndex(): View
    {
        $newsItems = LandingNewsItem::query()->orderBy('sort_order')->get();
        $setting = LandingSectionSetting::firstOrNew(['key' => 'news']);

        return view('admin.landing.news.index', compact('newsItems', 'setting'));
    }

    public function newsCreate(): View
    {
        return view('admin.landing.news.create');
    }

    public function newsStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'author_image_path' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        LandingNewsItem::create([
            'category' => $validated['category'] ?? null,
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'author_name' => $validated['author_name'] ?? null,
            'author_image_path' => $validated['author_image_path'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'link_url' => $validated['link_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.news.index')->with('status', 'News item added.');
    }

    public function newsEdit(LandingNewsItem $newsItem): View
    {
        return view('admin.landing.news.edit', compact('newsItem'));
    }

    public function newsUpdate(Request $request, LandingNewsItem $newsItem): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'author_image_path' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $newsItem->update([
            'category' => $validated['category'] ?? null,
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'author_name' => $validated['author_name'] ?? null,
            'author_image_path' => $validated['author_image_path'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'link_url' => $validated['link_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.news.index')->with('status', 'News item updated.');
    }

    public function newsDestroy(LandingNewsItem $newsItem): RedirectResponse
    {
        $newsItem->delete();

        return redirect()->route('admin.landing.news.index')->with('status', 'News item deleted.');
    }

    public function eventsIndex(): View
    {
        $events = LandingEvent::query()->orderBy('sort_order')->get();
        $setting = LandingSectionSetting::firstOrNew(['key' => 'events']);

        return view('admin.landing.events.index', compact('events', 'setting'));
    }

    public function eventsCreate(): View
    {
        return view('admin.landing.events.create');
    }

    public function eventsStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'event_time' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        LandingEvent::create([
            'category' => $validated['category'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'event_date' => $validated['event_date'] ?? null,
            'event_time' => $validated['event_time'] ?? null,
            'location' => $validated['location'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'cta_text' => $validated['cta_text'] ?? null,
            'cta_url' => $validated['cta_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.events.index')->with('status', 'Event added.');
    }

    public function eventsEdit(LandingEvent $event): View
    {
        return view('admin.landing.events.edit', compact('event'));
    }

    public function eventsUpdate(Request $request, LandingEvent $event): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'event_time' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $event->update([
            'category' => $validated['category'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'event_date' => $validated['event_date'] ?? null,
            'event_time' => $validated['event_time'] ?? null,
            'location' => $validated['location'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'cta_text' => $validated['cta_text'] ?? null,
            'cta_url' => $validated['cta_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.landing.events.index')->with('status', 'Event updated.');
    }

    public function eventsDestroy(LandingEvent $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('admin.landing.events.index')->with('status', 'Event deleted.');
    }
}
