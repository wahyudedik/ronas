<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\LandingHero;
use App\Models\News;
use App\Models\LandingProgram;
use App\Models\LandingSection;
use App\Models\LandingStat;
use App\Models\LandingStudentLifeItem;
use App\Models\LandingTestimonial;
use App\Models\AboutCoreValue;
use App\Models\AboutHistory;
use App\Models\AboutLeadershipSection;
use App\Models\AboutMissionVision;
use App\Models\AcademicsFacultyHighlight;
use App\Models\CampusFacilityCategory;
use App\Models\CampusHighlight;
use App\Models\StudentLifeSectionSetting;
use App\Models\AdmissionsApplicationStep;
use App\Models\AdmissionsDeadline;
use App\Models\AdmissionsDeadlineSetting;
use App\Models\AdmissionsPageSetting;
use App\Models\AdmissionsRequirement;
use App\Models\AdmissionsRequirementSetting;
use App\Models\AdmissionsRequestInfoSetting;
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
            ->where('category', '!=', 'gallery')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $studentLifeLandingSetting = StudentLifeSectionSetting::query()
            ->where('key', 'landing')
            ->first();

        $testimonials = LandingTestimonial::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $newsItems = News::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $eventItems = Event::query()
            ->where('is_active', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $facultyHighlights = AcademicsFacultyHighlight::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $campusHighlights = CampusHighlight::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(6)
            ->get();

        $campusCategories = CampusFacilityCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(3)
            ->get();

        $aboutHistory = AboutHistory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $aboutMission = AboutMissionVision::query()
            ->where('type', 'mission')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $aboutVision = AboutMissionVision::query()
            ->where('type', 'vision')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $aboutValues = AboutCoreValue::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(4)
            ->get();

        $aboutLeadership = AboutLeadershipSection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $aboutLeaders = $aboutLeadership
            ? $aboutLeadership->members()->where('is_active', true)->take(4)->get()
            : collect();

        $admissionsSetting = AdmissionsPageSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $admissionsSteps = AdmissionsApplicationStep::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(3)
            ->get();

        $admissionsRequirements = AdmissionsRequirement::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(4)
            ->get();

        $admissionsRequirementSetting = AdmissionsRequirementSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $admissionsDeadlines = AdmissionsDeadline::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(3)
            ->get();

        $admissionsDeadlineSetting = AdmissionsDeadlineSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $admissionsRequestInfo = AdmissionsRequestInfoSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        return view('college.index', compact(
            'sections',
            'hero',
            'stats',
            'featuredProgram',
            'otherPrograms',
            'studentLifeItems',
            'studentLifeLandingSetting',
            'testimonials',
            'newsItems',
            'eventItems',
            'aboutHistory',
            'aboutMission',
            'aboutVision',
            'aboutValues',
            'aboutLeadership',
            'aboutLeaders',
            'admissionsSetting',
            'admissionsSteps',
            'admissionsRequirements',
            'admissionsRequirementSetting',
            'admissionsDeadlines',
            'admissionsDeadlineSetting',
            'admissionsRequestInfo',
            'facultyHighlights',
            'campusHighlights',
            'campusCategories'
        ));
    }
}
