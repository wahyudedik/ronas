<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CollegeAboutController;
use App\Http\Controllers\CollegeAdmissionsController;
use App\Http\Controllers\CollegeAcademicsController;
use App\Http\Controllers\CollegeCampusFacilitiesController;
use App\Http\Controllers\CollegeStudentsLifeController;
use App\Http\Controllers\CollegeNewsController;
use App\Http\Controllers\CollegeEventsController;
use App\Http\Controllers\CollegeAlumniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\LandingSectionController;
use App\Http\Controllers\Admin\LandingHeroController;
use App\Http\Controllers\Admin\LandingStatController;
use App\Http\Controllers\Admin\LandingProgramController;
use App\Http\Controllers\Admin\LandingStudentLifeItemController;
use App\Http\Controllers\Admin\LandingTestimonialController;
use App\Http\Controllers\Admin\LandingNewsItemController;
use App\Http\Controllers\Admin\LandingEventItemController;
use App\Http\Controllers\Admin\AboutHistoryController;
use App\Http\Controllers\Admin\AboutHistoryMilestoneController;
use App\Http\Controllers\Admin\AboutMissionVisionController;
use App\Http\Controllers\Admin\AboutCoreValueController;
use App\Http\Controllers\Admin\AboutLeadershipSectionController;
use App\Http\Controllers\Admin\AboutLeadershipHighlightController;
use App\Http\Controllers\Admin\AboutLeadershipMemberController;
use App\Http\Controllers\Admin\AdmissionsPageSettingController;
use App\Http\Controllers\Admin\AdmissionsApplicationStepController;
use App\Http\Controllers\Admin\AdmissionsRequirementSettingController;
use App\Http\Controllers\Admin\AdmissionsRequirementController;
use App\Http\Controllers\Admin\AdmissionsTuitionSettingController;
use App\Http\Controllers\Admin\AdmissionsTuitionController;
use App\Http\Controllers\Admin\AdmissionsRequestInfoSettingController;
use App\Http\Controllers\Admin\AdmissionsRequestProgramController;
use App\Http\Controllers\Admin\AdmissionsDeadlineSettingController;
use App\Http\Controllers\Admin\AdmissionsDeadlineController;
use App\Http\Controllers\Admin\AdmissionsCampusVisitSettingController;
use App\Http\Controllers\Admin\AdmissionsCampusVisitOptionController;
use App\Http\Controllers\Admin\AcademicsFacultyHighlightController;
use App\Http\Controllers\Admin\StudentLifeSectionSettingController;
use App\Http\Controllers\Admin\CampusFacilityCategoryController;
use App\Http\Controllers\Admin\CampusFacilityItemController;
use App\Http\Controllers\Admin\CampusVirtualTourController;
use App\Http\Controllers\Admin\CampusVirtualTourFeatureController;
use App\Http\Controllers\Admin\CampusHighlightController;
use App\Http\Controllers\Admin\CampusMapSettingController;
use App\Http\Controllers\Admin\CampusMapCategoryController;
use App\Http\Controllers\Admin\CampusMapActionController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AlumniStoryController;
use App\Http\Controllers\Admin\AlumniEventController;
use App\Http\Controllers\Admin\GetInvolvedController;
use App\Http\Controllers\Admin\DonationCampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('college.index');
Route::get('/about', [CollegeAboutController::class, 'index'])->name('college.about');
Route::get('/admissions', [CollegeAdmissionsController::class, 'index'])->name('college.admissions');
Route::get('/academics', [CollegeAcademicsController::class, 'index'])->name('college.academics');
Route::view('/faculty-staff', 'college.faculty-staff')->name('college.faculty-staff');
Route::get('/campus-facilities', [CollegeCampusFacilitiesController::class, 'index'])->name('college.campus-facilities');
Route::get('/students-life', [CollegeStudentsLifeController::class, 'index'])->name('college.students-life');
Route::get('/news', [CollegeNewsController::class, 'index'])->name('college.news');
Route::get('/news/{news}', [CollegeNewsController::class, 'show'])->name('college.news.show');
Route::get('/events', [CollegeEventsController::class, 'index'])->name('college.events');
Route::get('/events/{event}', [CollegeEventsController::class, 'show'])->name('college.events.show');
Route::post('/events/{event}/register', [CollegeEventsController::class, 'register'])->name('college.events.register');

// Public Alumni Routes
Route::prefix('alumni')->name('college.alumni')->group(function () {
    Route::get('/', [CollegeAlumniController::class, 'index'])->name('.index');
    Route::get('/stories/{story}', [CollegeAlumniController::class, 'storyDetail'])->name('.story-detail');
    Route::match(['get', 'post'], '/submit-story', [CollegeAlumniController::class, 'submitStory'])->middleware('auth')->name('.submit-story');
    Route::get('/events', [CollegeAlumniController::class, 'events'])->name('.events');
    Route::get('/events/{event}', [CollegeAlumniController::class, 'eventDetail'])->name('.event-detail');
    Route::get('/donate/{campaign?}', [CollegeAlumniController::class, 'donate'])->name('.donate');
    Route::post('/donate/process', [CollegeAlumniController::class, 'processDonation'])->name('.process-donation');
});

Route::match(['get', 'post'], '/contact', [ContactController::class, 'index'])->name('college.contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('college.contact.store');
// Legal Pages (Dynamic)
Route::get('/legal/{slug}', [\App\Http\Controllers\LegalPageController::class, 'show'])->name('legal.show');
// Aliases for specific pages to match existing links if needed, or redirect
Route::get('/privacy', function () {
    return redirect()->route('legal.show', 'privacy');
})->name('college.privacy');
Route::get('/terms-of-service', function () {
    return redirect()->route('legal.show', 'terms-of-service');
})->name('college.terms-of-service');
Route::get('/starter-page', function () {
    return redirect()->route('legal.show', 'starter-page');
})->name('college.starter');
Route::view('/404', 'college.404')->name('college.404');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class)
        ->except(['show'])
        ->middleware('permission:manage users');

    Route::middleware('permission:manage landing')->prefix('dashboard/landing')->name('admin.landing.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.landing.sections.index');
        })->name('index');
        Route::get('student-life-sections', [StudentLifeSectionSettingController::class, 'index'])->name('student-life-sections.index');
        Route::put('student-life-sections/{key}', [StudentLifeSectionSettingController::class, 'update'])->name('student-life-sections.update');
        Route::post('sections/reorder', [LandingSectionController::class, 'reorder'])->name('sections.reorder');
        Route::patch('sections/{section}/toggle', [LandingSectionController::class, 'toggle'])->name('sections.toggle');
        Route::resource('sections', LandingSectionController::class);
        Route::post('heroes/reorder', [LandingHeroController::class, 'reorder'])->name('heroes.reorder');
        Route::patch('heroes/{hero}/toggle', [LandingHeroController::class, 'toggle'])->name('heroes.toggle');
        Route::resource('heroes', LandingHeroController::class);
        Route::post('stats/reorder', [LandingStatController::class, 'reorder'])->name('stats.reorder');
        Route::patch('stats/{stat}/toggle', [LandingStatController::class, 'toggle'])->name('stats.toggle');
        Route::resource('stats', LandingStatController::class);
        Route::post('programs/reorder', [LandingProgramController::class, 'reorder'])->name('programs.reorder');
        Route::patch('programs/{program}/toggle', [LandingProgramController::class, 'toggle'])->name('programs.toggle');
        Route::resource('programs', LandingProgramController::class);
        Route::post('student-life/reorder', [LandingStudentLifeItemController::class, 'reorder'])->name('student-life.reorder');
        Route::patch('student-life/{student_life}/toggle', [LandingStudentLifeItemController::class, 'toggle'])->name('student-life.toggle');
        Route::resource('student-life', LandingStudentLifeItemController::class);
        Route::post('testimonials/reorder', [LandingTestimonialController::class, 'reorder'])->name('testimonials.reorder');
        Route::patch('testimonials/{testimonial}/toggle', [LandingTestimonialController::class, 'toggle'])->name('testimonials.toggle');
        Route::resource('testimonials', LandingTestimonialController::class);
        Route::post('news/reorder', [LandingNewsItemController::class, 'reorder'])->name('news.reorder');
        Route::patch('news/{news}/toggle', [LandingNewsItemController::class, 'toggle'])->name('news.toggle');
        Route::resource('news', LandingNewsItemController::class);
        Route::post('events/reorder', [LandingEventItemController::class, 'reorder'])->name('events.reorder');
        Route::patch('events/{event}/toggle', [LandingEventItemController::class, 'toggle'])->name('events.toggle');
        Route::resource('events', LandingEventItemController::class);
    });

    Route::middleware('permission:manage about')->prefix('dashboard/about')->name('admin.about.')->group(function () {
        Route::get('/', function () {
            return view('admin.about.index');
        })->name('index');
        Route::post('histories/reorder', [AboutHistoryController::class, 'reorder'])->name('histories.reorder');
        Route::patch('histories/{history}/toggle', [AboutHistoryController::class, 'toggle'])->name('histories.toggle');
        Route::resource('histories', AboutHistoryController::class);
        Route::post('milestones/reorder', [AboutHistoryMilestoneController::class, 'reorder'])->name('milestones.reorder');
        Route::patch('milestones/{milestone}/toggle', [AboutHistoryMilestoneController::class, 'toggle'])->name('milestones.toggle');
        Route::resource('milestones', AboutHistoryMilestoneController::class);
        Route::post('mission-visions/reorder', [AboutMissionVisionController::class, 'reorder'])->name('mission-visions.reorder');
        Route::patch('mission-visions/{mission_vision}/toggle', [AboutMissionVisionController::class, 'toggle'])->name('mission-visions.toggle');
        Route::resource('mission-visions', AboutMissionVisionController::class);
        Route::post('core-values/reorder', [AboutCoreValueController::class, 'reorder'])->name('core-values.reorder');
        Route::patch('core-values/{core_value}/toggle', [AboutCoreValueController::class, 'toggle'])->name('core-values.toggle');
        Route::resource('core-values', AboutCoreValueController::class);
        Route::post('leadership-sections/reorder', [AboutLeadershipSectionController::class, 'reorder'])->name('leadership-sections.reorder');
        Route::patch('leadership-sections/{leadership_section}/toggle', [AboutLeadershipSectionController::class, 'toggle'])->name('leadership-sections.toggle');
        Route::resource('leadership-sections', AboutLeadershipSectionController::class);
        Route::post('leadership-highlights/reorder', [AboutLeadershipHighlightController::class, 'reorder'])->name('leadership-highlights.reorder');
        Route::patch('leadership-highlights/{leadership_highlight}/toggle', [AboutLeadershipHighlightController::class, 'toggle'])->name('leadership-highlights.toggle');
        Route::resource('leadership-highlights', AboutLeadershipHighlightController::class);
        Route::post('leadership-members/reorder', [AboutLeadershipMemberController::class, 'reorder'])->name('leadership-members.reorder');
        Route::patch('leadership-members/{leadership_member}/toggle', [AboutLeadershipMemberController::class, 'toggle'])->name('leadership-members.toggle');
        Route::resource('leadership-members', AboutLeadershipMemberController::class);
    });

    Route::middleware('permission:manage admissions')->prefix('dashboard/admissions')->name('admin.admissions.')->group(function () {
        Route::get('/', function () {
            return view('admin.admissions.index');
        })->name('index');
        Route::resource('page-settings', AdmissionsPageSettingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('application-steps/reorder', [AdmissionsApplicationStepController::class, 'reorder'])->name('application-steps.reorder');
        Route::patch('application-steps/{application_step}/toggle', [AdmissionsApplicationStepController::class, 'toggle'])->name('application-steps.toggle');
        Route::resource('application-steps', AdmissionsApplicationStepController::class);
        Route::resource('requirement-settings', AdmissionsRequirementSettingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('requirements/reorder', [AdmissionsRequirementController::class, 'reorder'])->name('requirements.reorder');
        Route::patch('requirements/{requirement}/toggle', [AdmissionsRequirementController::class, 'toggle'])->name('requirements.toggle');
        Route::resource('requirements', AdmissionsRequirementController::class);
        Route::resource('tuition-settings', AdmissionsTuitionSettingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('tuitions/reorder', [AdmissionsTuitionController::class, 'reorder'])->name('tuitions.reorder');
        Route::patch('tuitions/{tuition}/toggle', [AdmissionsTuitionController::class, 'toggle'])->name('tuitions.toggle');
        Route::resource('tuitions', AdmissionsTuitionController::class);
        Route::resource('request-info-settings', AdmissionsRequestInfoSettingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('request-programs/reorder', [AdmissionsRequestProgramController::class, 'reorder'])->name('request-programs.reorder');
        Route::patch('request-programs/{request_program}/toggle', [AdmissionsRequestProgramController::class, 'toggle'])->name('request-programs.toggle');
        Route::resource('request-programs', AdmissionsRequestProgramController::class);
        Route::resource('deadline-settings', AdmissionsDeadlineSettingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('deadlines/reorder', [AdmissionsDeadlineController::class, 'reorder'])->name('deadlines.reorder');
        Route::patch('deadlines/{deadline}/toggle', [AdmissionsDeadlineController::class, 'toggle'])->name('deadlines.toggle');
        Route::resource('deadlines', AdmissionsDeadlineController::class);
        Route::resource('campus-visit-settings', AdmissionsCampusVisitSettingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('campus-visit-options/reorder', [AdmissionsCampusVisitOptionController::class, 'reorder'])->name('campus-visit-options.reorder');
        Route::patch('campus-visit-options/{campus_visit_option}/toggle', [AdmissionsCampusVisitOptionController::class, 'toggle'])->name('campus-visit-options.toggle');
        Route::resource('campus-visit-options', AdmissionsCampusVisitOptionController::class);
    });

    Route::middleware('permission:manage academics')->prefix('dashboard/academics')->name('admin.academics.')->group(function () {
        Route::get('/', function () {
            return view('admin.academics.index');
        })->name('index');
        Route::post('faculty-highlights/reorder', [AcademicsFacultyHighlightController::class, 'reorder'])->name('faculty-highlights.reorder');
        Route::patch('faculty-highlights/{faculty_highlight}/toggle', [AcademicsFacultyHighlightController::class, 'toggle'])->name('faculty-highlights.toggle');
        Route::resource('faculty-highlights', AcademicsFacultyHighlightController::class);
    });

    Route::middleware('permission:manage facilities')->prefix('dashboard/facilities')->name('admin.facilities.')->group(function () {
        Route::get('/', function () {
            return view('admin.facilities.index');
        })->name('index');
        Route::post('categories/reorder', [CampusFacilityCategoryController::class, 'reorder'])->name('categories.reorder');
        Route::patch('categories/{category}/toggle', [CampusFacilityCategoryController::class, 'toggle'])->name('categories.toggle');
        Route::resource('categories', CampusFacilityCategoryController::class);
        Route::post('items/reorder', [CampusFacilityItemController::class, 'reorder'])->name('items.reorder');
        Route::patch('items/{item}/toggle', [CampusFacilityItemController::class, 'toggle'])->name('items.toggle');
        Route::resource('items', CampusFacilityItemController::class);
        Route::patch('virtual-tours/{virtual_tour}/toggle', [CampusVirtualTourController::class, 'toggle'])->name('virtual-tours.toggle');
        Route::resource('virtual-tours', CampusVirtualTourController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('virtual-tour-features/reorder', [CampusVirtualTourFeatureController::class, 'reorder'])->name('virtual-tour-features.reorder');
        Route::patch('virtual-tour-features/{feature}/toggle', [CampusVirtualTourFeatureController::class, 'toggle'])->name('virtual-tour-features.toggle');
        Route::resource('virtual-tour-features', CampusVirtualTourFeatureController::class)
            ->parameters(['virtual-tour-features' => 'feature']);
        Route::post('highlights/reorder', [CampusHighlightController::class, 'reorder'])->name('highlights.reorder');
        Route::patch('highlights/{highlight}/toggle', [CampusHighlightController::class, 'toggle'])->name('highlights.toggle');
        Route::resource('highlights', CampusHighlightController::class);
        Route::patch('map-settings/{map_setting}/toggle', [CampusMapSettingController::class, 'toggle'])->name('map-settings.toggle');
        Route::resource('map-settings', CampusMapSettingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::post('map-categories/reorder', [CampusMapCategoryController::class, 'reorder'])->name('map-categories.reorder');
        Route::patch('map-categories/{map_category}/toggle', [CampusMapCategoryController::class, 'toggle'])->name('map-categories.toggle');
        Route::resource('map-categories', CampusMapCategoryController::class);
        Route::post('map-actions/reorder', [CampusMapActionController::class, 'reorder'])->name('map-actions.reorder');
        Route::patch('map-actions/{map_action}/toggle', [CampusMapActionController::class, 'toggle'])->name('map-actions.toggle');
        Route::resource('map-actions', CampusMapActionController::class);
    });

    Route::middleware('permission:manage news')->prefix('dashboard')->name('admin.')->group(function () {
        Route::resource('news', NewsController::class);
    });

    Route::middleware('permission:manage events')->prefix('dashboard')->name('admin.')->group(function () {
        Route::resource('events', EventController::class);
    });

    // Admin Alumni Routes - For now, we'll assume general admin access or create a new permission later.
    // Using 'auth' middleware is already covered by the parent group.
    Route::prefix('dashboard/alumni')->name('admin.alumni.')->group(function () {
        Route::resource('stories', AlumniStoryController::class);
        Route::resource('events', AlumniEventController::class);
        Route::resource('involved', GetInvolvedController::class);
        Route::resource('donations', DonationCampaignController::class);
    });
    // Admin Contact Routes
    Route::prefix('dashboard/contact')->name('admin.contact.')->group(function () {
        Route::get('info', [ContactInfoController::class, 'index'])->name('info.index');
        Route::get('info/edit/{contact}', [ContactInfoController::class, 'edit'])->name('info.edit');
        Route::put('info/update/{contact}', [ContactInfoController::class, 'update'])->name('info.update');

        Route::resource('messages', ContactMessageController::class);

        Route::get('settings', [ContactSettingController::class, 'index'])->name('settings.index');
        Route::put('settings/update', [ContactSettingController::class, 'update'])->name('settings.update');
    });

    // Admin Legal Pages Routes
    Route::middleware('permission:manage legal pages')->prefix('dashboard/legal')->name('admin.legal.')->group(function () {
        Route::resource('pages', \App\Http\Controllers\Admin\LegalPageController::class);
    });

    Route::post('/dashboard/upload-image', [UploadController::class, 'upload'])->name('admin.upload');
});

require __DIR__ . '/auth.php';
