@extends('college.layouts.app')

@section('title', 'Academics - College Bootstrap Template')
@section('body-class', 'academics-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Academics</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">Academics</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Academics Section -->
    <section id="academics" class="academics section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row mb-5">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="section-intro pe-lg-5">
              <h3 class="section-heading">Discover Our Educational Excellence</h3>
              <p class="lead">Explore programs across undergraduate, graduate, and certificate levels tailored to student success.</p>
              <p>Filter programs by level and meet the faculty who guide every learning journey.</p>
              <div class="cta-buttons mt-4">
                <a href="#academics" class="btn btn-primary me-3">Explore Programs</a>
                <a href="#faculty" class="btn btn-outline">Meet Faculty</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="row key-metrics g-4">
              <div class="col-6">
                <div class="metric-card">
                  <h2><span data-purecounter-start="0" data-purecounter-end="{{ $programCounts['undergraduate'] ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                  <p>Undergraduate Programs</p>
                </div>
              </div>
              <div class="col-6">
                <div class="metric-card">
                  <h2><span data-purecounter-start="0" data-purecounter-end="{{ $programCounts['graduate'] ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                  <p>Graduate Programs</p>
                </div>
              </div>
              <div class="col-6">
                <div class="metric-card">
                  <h2><span data-purecounter-start="0" data-purecounter-end="{{ $programCounts['certificate'] ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                  <p>Certificates</p>
                </div>
              </div>
              <div class="col-6">
                <div class="metric-card">
                  <h2><span data-purecounter-start="0" data-purecounter-end="{{ $programs->count() }}" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                  <p>Total Programs</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="programs-section mb-5">
          <div class="section-header text-center mb-5" data-aos="fade-up" data-aos-delay="200">
            <h3>Our Academic Programs</h3>
            <p>Explore programs by level and find the right fit for you.</p>
          </div>

          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <ul class="programs-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
              <li data-filter="*" class="filter-active">All Programs</li>
              @foreach($programLevels as $levelKey => $label)
                <li data-filter=".filter-{{ $levelKey }}">{{ $label }}</li>
              @endforeach
            </ul>

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              @forelse($programs as $program)
                @php
                  $levelKey = $program->program_level ?? 'undergraduate';
                @endphp
                <div class="col-lg-4 col-md-6 program-item isotope-item filter-{{ $levelKey }}">
                  <div class="program-card">
                    <div class="program-img">
                      @if($program->image)
                        <img src="{{ asset(ltrim($program->image, '/')) }}" alt="{{ $program->title }}" class="img-fluid">
                      @endif
                      <div class="program-tag">{{ $programLevels[$levelKey] ?? ucfirst($levelKey) }}</div>
                    </div>
                    <div class="program-content">
                      <h4>{{ $program->title }}</h4>
                      <p>{{ $program->description }}</p>
                      <div class="program-meta">
                        @if($program->duration_text)
                          <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>{{ $program->duration_text }}</span>
                          </div>
                        @endif
                        @if($program->degree_text)
                          <div class="meta-item">
                            <i class="bi bi-mortarboard"></i>
                            <span>{{ $program->degree_text }}</span>
                          </div>
                        @endif
                      </div>
                      <a href="#" class="program-link">Learn More <i class="bi bi-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12">
                  <p class="text-center">No programs available.</p>
                </div>
              @endforelse
            </div>
          </div>
        </div>

        @if($facultyHighlights->isNotEmpty())
        <div id="faculty" class="faculty-section">
          <div class="section-header text-center mb-5" data-aos="fade-up" data-aos-delay="200">
            <h3>Meet Our Faculty</h3>
            <p>Learn from experienced educators and industry leaders</p>
          </div>

          <div class="row g-4">
            @foreach($facultyHighlights as $highlight)
              <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="faculty-card">
                  <div class="faculty-img">
                    @if($highlight->image)
                      <img src="{{ asset(ltrim($highlight->image, '/')) }}" alt="{{ $highlight->name }}" class="img-fluid">
                    @endif
                  </div>
                  <div class="faculty-content">
                    <h4>{{ $highlight->name }}</h4>
                    <p class="faculty-position">{{ $highlight->role }}</p>
                    <div class="faculty-social">
                      @if($highlight->linkedin_url)
                        <a href="{{ $highlight->linkedin_url }}" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                      @endif
                      @if($highlight->twitter_url)
                        <a href="{{ $highlight->twitter_url }}" target="_blank" rel="noopener"><i class="bi bi-twitter"></i></a>
                      @endif
                      @if($highlight->email)
                        <a href="mailto:{{ $highlight->email }}"><i class="bi bi-envelope"></i></a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @endif

      </div>

    </section><!-- /Academics Section -->

  </main>
@endsection
