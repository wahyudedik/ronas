@extends('college.layouts.app')

@section('title', 'Home - College')
@section('body-class', 'index-page')

@section('main')
    @php
        $statsSection = $sections['stats'] ?? null;
        $programsSection = $sections['programs'] ?? null;
        $facultyHighlightsSection = $sections['faculty_highlights'] ?? null;
        $studentLifeSection = $sections['student_life'] ?? null;
        $admissionsSection = $sections['admissions'] ?? null;
        $testimonialsSection = $sections['testimonials'] ?? null;
        $newsSection = $sections['news'] ?? null;
        $eventsSection = $sections['events'] ?? null;
        $campusFacilitiesSection = $sections['campus_facilities'] ?? null;
        $showPrograms = !$programsSection || $programsSection->is_active;
        $showStudentLife = !$studentLifeSection || $studentLifeSection->is_active;
        $landingStudentLifeTitle =
            $studentLifeLandingSetting?->title ?? ($studentLifeSection?->title ?? 'Students Life');
        $landingStudentLifeSubtitle = $studentLifeLandingSetting?->subtitle ?? ($studentLifeSection?->subtitle ?? '');
        $showFacultyHighlights = !$facultyHighlightsSection || $facultyHighlightsSection->is_active;
        $showTestimonials = !$testimonialsSection || $testimonialsSection->is_active;
        $showStats = !$statsSection || $statsSection->is_active;
        $showNews = !$newsSection || $newsSection->is_active;
        $showEvents = !$eventsSection || $eventsSection->is_active;
        $showAdmissions = !$admissionsSection || $admissionsSection->is_active;
        $showCampusFacilities = !$campusFacilitiesSection || $campusFacilitiesSection->is_active;
    @endphp

    <main class="main">
        <section id="hero" class="hero section">
            <div class="hero-wrapper">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-content" data-aos="fade-right" data-aos-delay="100">
                            <h1>{{ $hero->title ?? 'Inspiring Excellence Through Education' }}</h1>
                            <p>{{ $hero->description ?? '' }}</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <span class="stat-number">{{ $hero->stat_one_value ?? '' }}</span>
                                    <span class="stat-label">{{ $hero->stat_one_label ?? '' }}</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ $hero->stat_two_value ?? '' }}</span>
                                    <span class="stat-label">{{ $hero->stat_two_label ?? '' }}</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ $hero->stat_three_value ?? '' }}</span>
                                    <span class="stat-label">{{ $hero->stat_three_label ?? '' }}</span>
                                </div>
                            </div>
                            <div class="action-buttons">
                                @if (!empty($hero?->primary_label))
                                    <a href="{{ $hero->primary_url ?? '#' }}"
                                        class="btn-primary">{{ $hero->primary_label }}</a>
                                @endif
                                @if (!empty($hero?->secondary_label))
                                    <a href="{{ $hero->secondary_url ?? '#' }}"
                                        class="btn-secondary">{{ $hero->secondary_label }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 hero-media" data-aos="zoom-in" data-aos-delay="200">
                            @if (!empty($hero?->image))
                                <img src="{{ asset(ltrim($hero->image, '/')) }}" alt="Hero"
                                    class="img-fluid main-image">
                            @endif
                            @if (!empty($hero?->badge_text))
                                <div class="image-overlay">
                                    <div class="badge-accredited">
                                        <i class="{{ $hero->badge_icon ?? 'bi bi-patch-check-fill' }}"></i>
                                        <span>{{ $hero->badge_text }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($hero?->event_title))
                <div class="upcoming-event" data-aos="fade-up" data-aos-delay="400">
                    <div class="container">
                        <div class="event-content">
                            <div class="event-date">
                                <span class="day">{{ $hero->event_day }}</span>
                                <span class="month">{{ $hero->event_month }}</span>
                            </div>
                            <div class="event-info">
                                <h3>{{ $hero->event_title }}</h3>
                                <p>{{ $hero->event_description }}</p>
                            </div>
                            <div class="event-action">
                                @if (!empty($hero->event_button_label))
                                    <a href="{{ $hero->event_button_url ?? '#' }}"
                                        class="btn-event">{{ $hero->event_button_label }}</a>
                                @endif
                                @if (!empty($hero->event_countdown_text))
                                    <span class="countdown">{{ $hero->event_countdown_text }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        @if ($aboutHistory || $aboutMission || $aboutVision || $aboutValues->isNotEmpty() || $aboutLeadership)
            <section id="about" class="about section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $aboutHistory?->title ?? 'About Our Campus' }}</h2>
                    <p>{{ $aboutHistory?->heading ?? '' }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row gy-4 align-items-start">
                        <div class="col-lg-6">
                            <div class="about-content">
                                <p>{{ $aboutHistory?->description ?? '' }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('college.about') }}" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @if (!empty($aboutHistory?->image))
                                <img src="{{ asset(ltrim($aboutHistory->image, '/')) }}" alt="About"
                                    class="img-fluid rounded">
                            @endif
                            <div class="row mt-4 g-3">
                                @if ($aboutMission)
                                    <div class="col-md-6">
                                        <div class="p-3 border rounded h-100">
                                            <h5 class="mb-2">{{ $aboutMission?->title ?? 'Our Mission' }}</h5>
                                            <p class="mb-0">{{ $aboutMission?->description ?? '' }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if ($aboutVision)
                                    <div class="col-md-6">
                                        <div class="p-3 border rounded h-100">
                                            <h5 class="mb-2">{{ $aboutVision?->title ?? 'Our Vision' }}</h5>
                                            <p class="mb-0">{{ $aboutVision?->description ?? '' }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($aboutValues->isNotEmpty())
                        <div class="row mt-5 g-4">
                            @foreach ($aboutValues as $value)
                                <div class="col-md-6 col-lg-3">
                                    <div class="value-card h-100">
                                        <div class="value-icon">
                                            <i class="{{ $value->icon_class ?? 'bi bi-stars' }}"></i>
                                        </div>
                                        <h4>{{ $value->title }}</h4>
                                        <p>{{ $value->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($aboutLeadership && $aboutLeaders->isNotEmpty())
                        <div class="row mt-5 g-4">
                            <div class="col-12">
                                <h3 class="mb-3">{{ $aboutLeadership?->title ?? 'Leadership Team' }}</h3>
                            </div>
                            @foreach ($aboutLeaders as $leader)
                                <div class="col-md-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="card-inner">
                                            <div class="card-front">
                                                <div class="member-image">
                                                    @if ($leader->image)
                                                        <img src="{{ asset(ltrim($leader->image, '/')) }}"
                                                            alt="{{ $leader->name }}" class="img-fluid">
                                                    @endif
                                                </div>
                                                <div class="member-info">
                                                    <h4>{{ $leader->name }}</h4>
                                                    <p>{{ $leader->role }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

        @if ($showCampusFacilities && ($campusHighlights->isNotEmpty() || $campusCategories->isNotEmpty()))
            <section id="campus-facilities" class="campus-facilities section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $campusFacilitiesSection->title ?? 'Campus Facilities' }}</h2>
                    <p>{{ $campusFacilitiesSection->subtitle ?? 'Explore our modern spaces and student services.' }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    @if ($campusHighlights->isNotEmpty())
                        <div class="row g-4">
                            @foreach ($campusHighlights as $highlight)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 shadow-sm border-0">
                                        @if ($highlight->image)
                                            <img src="{{ asset(ltrim($highlight->image, '/')) }}"
                                                alt="{{ $highlight->title }}" class="card-img-top">
                                        @endif
                                        <div class="card-body">
                                            @if ($highlight->category_label)
                                                <span
                                                    class="badge bg-light text-muted mb-2">{{ $highlight->category_label }}</span>
                                            @endif
                                            <h5 class="card-title">{{ $highlight->title }}</h5>
                                            <p class="card-text">{{ $highlight->description }}</p>
                                            <div class="d-flex flex-column gap-2 small text-muted">
                                                @if ($highlight->stat_one_label)
                                                    <span><i class="{{ $highlight->stat_one_icon ?? 'bi bi-star' }}"></i>
                                                        {{ $highlight->stat_one_label }}</span>
                                                @endif
                                                @if ($highlight->stat_two_label)
                                                    <span><i class="{{ $highlight->stat_two_icon ?? 'bi bi-star' }}"></i>
                                                        {{ $highlight->stat_two_label }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($campusCategories->isNotEmpty())
                        <div class="row g-3 mt-4">
                            @foreach ($campusCategories as $category)
                                <div class="col-md-4">
                                    <div class="p-4 border rounded h-100">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="{{ $category->icon_class ?? 'bi bi-building' }}"></i>
                                            <h5 class="mb-0">{{ $category->name }}</h5>
                                        </div>
                                        <p class="text-muted mb-3">{{ $category->description }}</p>
                                        <a href="{{ $category->button_url ?? route('college.campus-facilities') }}"
                                            class="text-decoration-underline">
                                            {{ $category->button_label ?? 'Explore Facilities' }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('college.campus-facilities') }}" class="btn btn-primary">Explore Campus
                            Facilities</a>
                    </div>
                </div>
            </section>
        @endif

        @if ($showPrograms)
            <section id="featured-programs" class="featured-programs section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $programsSection->title ?? 'Featured Programs' }}</h2>
                    <p>{{ $programsSection->subtitle ?? '' }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row gy-5">
                        @if ($featuredProgram)
                            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                                <div class="program-banner">
                                    <div class="banner-image">
                                        @if ($featuredProgram->image)
                                            <img src="{{ asset(ltrim($featuredProgram->image, '/')) }}" alt="Program"
                                                class="img-fluid">
                                        @endif
                                        @if ($featuredProgram->badge_text)
                                            <div class="banner-badge">
                                                <span class="badge-text">{{ $featuredProgram->badge_text }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="banner-info">
                                        <div class="program-header">
                                            <h3>{{ $featuredProgram->title }}</h3>
                                            <div class="program-stats">
                                                @if ($featuredProgram->meta_one)
                                                    <span><i class="bi bi-people-fill"></i>
                                                        {{ $featuredProgram->meta_one }}</span>
                                                @endif
                                                @if ($featuredProgram->meta_two)
                                                    <span><i class="bi bi-award-fill"></i>
                                                        {{ $featuredProgram->meta_two }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p>{{ $featuredProgram->description }}</p>
                                        <div class="program-details">
                                            @if ($featuredProgram->duration_text)
                                                <div class="detail-item">
                                                    <i class="bi bi-calendar-check"></i>
                                                    <span>{{ $featuredProgram->duration_text }}</span>
                                                </div>
                                            @endif
                                            @if ($featuredProgram->degree_text)
                                                <div class="detail-item">
                                                    <i class="bi bi-mortarboard-fill"></i>
                                                    <span>{{ $featuredProgram->degree_text }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-6">
                            <div class="programs-grid">
                                <div class="row g-3">
                                    @foreach ($otherPrograms as $program)
                                        <div class="col-12" data-aos="fade-left">
                                            <div class="program-item">
                                                <div class="item-icon">
                                                    @if ($program->image)
                                                        <img src="{{ asset(ltrim($program->image, '/')) }}"
                                                            alt="Program" class="img-fluid">
                                                    @endif
                                                </div>
                                                <div class="item-content">
                                                    <h4>{{ $program->title }}</h4>
                                                    <p>{{ $program->description }}</p>
                                                    <div class="meta-info">
                                                        <span>{{ $program->duration_text }}</span>
                                                        <span>{{ $program->degree_text }}</span>
                                                    </div>
                                                </div>
                                                <div class="item-arrow">
                                                    <i class="bi bi-arrow-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($showFacultyHighlights && $facultyHighlights->isNotEmpty())
            <section id="faculty-highlights" class="faculty section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $facultyHighlightsSection->title ?? 'Meet Our Faculty' }}</h2>
                    <p>{{ $facultyHighlightsSection->subtitle ?? '' }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row g-4">
                        @foreach ($facultyHighlights as $highlight)
                            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                                <div class="faculty-card">
                                    <div class="faculty-img">
                                        @if ($highlight->image)
                                            <img src="{{ asset(ltrim($highlight->image, '/')) }}"
                                                alt="{{ $highlight->name }}" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="faculty-content">
                                        <h4>{{ $highlight->name }}</h4>
                                        <p class="faculty-position">{{ $highlight->role }}</p>
                                        <div class="faculty-social">
                                            @if ($highlight->linkedin_url)
                                                <a href="{{ $highlight->linkedin_url }}" target="_blank"
                                                    rel="noopener"><i class="bi bi-linkedin"></i></a>
                                            @endif
                                            @if ($highlight->twitter_url)
                                                <a href="{{ $highlight->twitter_url }}" target="_blank"
                                                    rel="noopener"><i class="bi bi-twitter"></i></a>
                                            @endif
                                            @if ($highlight->email)
                                                <a href="mailto:{{ $highlight->email }}"><i
                                                        class="bi bi-envelope"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if (
            $showAdmissions &&
                ($admissionsSteps->isNotEmpty() || $admissionsRequirements->isNotEmpty() || $admissionsDeadlines->isNotEmpty()))
            <section id="admissions" class="admissions section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $admissionsSection?->title ?? ($admissionsSetting?->page_title ?? 'Admissions') }}</h2>
                    <p>{{ $admissionsSection?->subtitle ?? ($admissionsSection?->description ?? '') }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <h4 class="mb-3">{{ $admissionsSetting?->steps_title ?? 'Steps' }}</h4>
                            <ul class="list-unstyled">
                                @foreach ($admissionsSteps as $step)
                                    <li class="mb-3">
                                        <strong>{{ $step->step_number ?? str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</strong>
                                        <div>{{ $step->title }}</div>
                                        <small class="text-muted">{{ $step->description }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="mb-3">{{ $admissionsRequirementSetting?->title ?? 'Requirements' }}</h4>
                            <ul class="list-unstyled">
                                @foreach ($admissionsRequirements as $requirement)
                                    <li class="mb-2"><i class="bi bi-check-circle me-2"></i>{{ $requirement->text }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="mb-3">{{ $admissionsDeadlineSetting?->title ?? 'Deadlines' }}</h4>
                            <ul class="list-unstyled">
                                @foreach ($admissionsDeadlines as $deadline)
                                    <li class="mb-2">
                                        <strong>{{ $deadline->date_text }}</strong> - {{ $deadline->title }}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('college.admissions') }}" class="btn btn-primary mt-3">
                                {{ $admissionsRequestInfo?->submit_label ?? 'See Admissions' }}
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($showStudentLife)
            <section id="students-life-block" class="students-life-block section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $landingStudentLifeTitle }}</h2>
                    <p>{{ $landingStudentLifeSubtitle }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="activities-showcase">
                        <div class="row g-4">
                            @foreach ($studentLifeItems as $item)
                                <div class="col-lg-4" data-aos="fade-up">
                                    <div class="activity-item">
                                        <div class="activity-thumb">
                                            @if ($item->image)
                                                <img src="{{ asset(ltrim($item->image, '/')) }}"
                                                    alt="{{ $item->title }}" class="img-fluid">
                                            @endif
                                        </div>
                                        <div class="activity-info">
                                            <h6>{{ $item->title }}</h6>
                                            <p>{{ $item->description }}</p>
                                            @if ($item->link_label)
                                                <a href="{{ $item->link_url ?? '#' }}"
                                                    class="btn-link">{{ $item->link_label }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($showTestimonials)
            <section id="testimonials" class="testimonials section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $testimonialsSection->title ?? 'Testimonials' }}</h2>
                    <p>{{ $testimonialsSection->subtitle ?? '' }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-slider swiper init-swiper">
                        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": { "delay": 4000 },
            "slidesPerView": 1,
            "spaceBetween": 30,
            "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" },
            "breakpoints": { "768": { "slidesPerView": 2 }, "1200": { "slidesPerView": 3 } }
          }
        </script>
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="testimonial-item" data-aos="zoom-in">
                                        <div class="testimonial-header">
                                            @if ($testimonial->image)
                                                <img src="{{ asset(ltrim($testimonial->image, '/')) }}"
                                                    alt="{{ $testimonial->name }}" class="img-fluid" loading="lazy">
                                            @endif
                                            <div class="rating">
                                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <p>{{ $testimonial->quote }}</p>
                                        </div>
                                        <div class="testimonial-footer">
                                            <h5>{{ $testimonial->name }}</h5>
                                            <span>{{ $testimonial->role }}</span>
                                            <div class="quote-icon">
                                                <i class="bi bi-chat-quote-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-navigation">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($showStats)
            <section id="stats" class="stats section">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="intro-content" data-aos="fade-up" data-aos-delay="200">
                                <h2 class="section-heading">
                                    {{ $statsSection->title ?? 'Transforming Lives Through Quality Education' }}</h2>
                                <p class="section-description">{{ $statsSection->description ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4">
                        @foreach ($stats as $stat)
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="metric-card" data-aos="flip-left">
                                    <div class="metric-header">
                                        <div class="metric-icon-wrapper">
                                            <i class="{{ $stat->icon_class ?? 'bi bi-mortarboard-fill' }}"></i>
                                        </div>
                                        <div class="metric-value">
                                            <span class="purecounter" data-purecounter-start="0"
                                                data-purecounter-end="{{ $stat->value }}"
                                                data-purecounter-duration="1"></span>{{ $stat->suffix }}
                                        </div>
                                    </div>
                                    <div class="metric-info">
                                        <h4>{{ $stat->label }}</h4>
                                        <p>{{ $stat->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($showNews)
            <section id="recent-news" class="recent-news section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $newsSection->title ?? 'Recent News' }}</h2>
                    <p>{{ $newsSection->subtitle ?? '' }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row gy-4">
                        @foreach ($newsItems as $item)
                            <div class="col-xl-6" data-aos="fade-up">
                                <article class="post-item d-flex">
                                    <div class="post-img">
                                        @if ($item->image)
                                            <img src="{{ asset(ltrim($item->image, '/')) }}" alt=""
                                                class="img-fluid" loading="lazy">
                                        @endif
                                    </div>
                                    <div class="post-content flex-grow-1">
                                        @if ($item->category)
                                            <a href="{{ route('college.news') }}?category={{ $item->category->slug ?? '' }}"
                                                class="category">{{ $item->category->name ?? '' }}</a>
                                        @endif
                                        <h2 class="post-title">
                                            <a href="{{ route('college.news.show', $item) }}">{{ $item->title }}</a>
                                        </h2>
                                        @if ($item->excerpt)
                                            <p class="post-description">{{ $item->excerpt }}</p>
                                        @endif
                                        <div class="post-meta">
                                            <div class="post-author">
                                                @if ($item->author_image)
                                                    <img src="{{ asset(ltrim($item->author_image, '/')) }}"
                                                        alt="" class="img-fluid">
                                                @endif
                                                <span class="author-name">{{ $item->author->name ?? 'Admin' }}</span>
                                            </div>
                                            <span
                                                class="post-date">{{ optional($item->published_at)->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($showEvents)
            <section id="events" class="events section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $eventsSection->title ?? 'Events' }}</h2>
                    <p>{{ $eventsSection->subtitle ?? '' }}</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row g-4">
                        @foreach ($eventItems as $event)
                            <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                                <div class="event-item">
                                    <div class="event-image">
                                        @if ($event->image)
                                            <img src="{{ asset(ltrim($event->image, '/')) }}" alt="Event"
                                                class="img-fluid">
                                        @endif
                                        @if ($event->start_date)
                                            <div class="event-date-overlay">
                                                <span
                                                    class="date">{{ $event->start_date->format('M') }}<br>{{ $event->start_date->format('d') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="event-details">
                                        <div class="event-category">
                                            @if ($event->category)
                                                <span class="badge academic">{{ $event->category->name }}</span>
                                            @endif
                                            @if ($event->start_time)
                                                <span
                                                    class="event-time">{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</span>
                                            @endif
                                        </div>
                                        <h3>{{ $event->title }}</h3>
                                        @if ($event->description)
                                            <p>{{ Str::limit($event->description, 100) }}</p>
                                        @endif
                                        <div class="event-info">
                                            @if ($event->venue)
                                                <div class="info-row">
                                                    <i class="bi bi-geo-alt"></i>
                                                    <span>{{ $event->venue }}</span>
                                                </div>
                                            @endif
                                            @if ($event->capacity)
                                                <div class="info-row">
                                                    <i class="bi bi-people"></i>
                                                    <span>{{ $event->capacity }} Seats</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="event-footer">
                                            <a href="{{ route('college.events.show', $event) }}"
                                                class="register-btn">Learn More</a>
                                            <div class="event-share">
                                                <i class="bi bi-share"></i>
                                                <i class="bi bi-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </main>
@endsection
