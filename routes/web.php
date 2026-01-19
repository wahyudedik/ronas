<?php

use App\Http\Controllers\LandingPageController;
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
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('college.index');
Route::view('/about', 'college.about')->name('college.about');
Route::view('/admissions', 'college.admissions')->name('college.admissions');
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
});

require __DIR__ . '/auth.php';
