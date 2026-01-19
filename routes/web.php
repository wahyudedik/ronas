<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CollegeAboutController;
use App\Http\Controllers\CollegeAdmissionsController;
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
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('college.index');
Route::get('/about', [CollegeAboutController::class, 'index'])->name('college.about');
Route::get('/admissions', [CollegeAdmissionsController::class, 'index'])->name('college.admissions');
Route::view('/academics', 'college.academics')->name('college.academics');
Route::view('/faculty-staff', 'college.faculty-staff')->name('college.faculty-staff');
Route::view('/campus-facilities', 'college.campus-facilities')->name('college.campus-facilities');
Route::view('/students-life', 'college.students-life')->name('college.students-life');
Route::view('/news', 'college.news')->name('college.news');
Route::view('/news-details', 'college.news-details')->name('college.news-details');
Route::view('/events', 'college.events')->name('college.events');
Route::view('/event-details', 'college.event-details')->name('college.event-details');
Route::view('/alumni', 'college.alumni')->name('college.alumni');
Route::view('/contact', 'college.contact')->name('college.contact');
Route::view('/privacy', 'college.privacy')->name('college.privacy');
Route::view('/terms-of-service', 'college.terms-of-service')->name('college.terms-of-service');
Route::view('/starter-page', 'college.starter-page')->name('college.starter');
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
});

require __DIR__ . '/auth.php';
