@extends('college.layouts.app')

@section('title', 'About - College Bootstrap Template')
@section('body-class', 'about-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">About</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">About</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- History Section -->
    <section id="history" class="history section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <div class="about-content" data-aos="fade-up" data-aos-delay="200">
              <h3>{{ $history?->title ?? 'Our Story' }}</h3>
              <h2>{{ $history?->heading ?? 'Educating Minds, Inspiring Hearts' }}</h2>
              <p>{{ $history?->description ?? '' }}</p>

              @if($milestones->isNotEmpty())
              <div class="timeline">
                @foreach($milestones as $milestone)
                  <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                      <h4>{{ $milestone->year }}</h4>
                      <p>{{ $milestone->description }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
              @endif
            </div>
          </div>

          <div class="col-lg-6">
            <div class="about-image" data-aos="zoom-in" data-aos-delay="300">
              <img src="{{ $history?->image ? asset(ltrim($history->image, '/')) : asset('College/assets/img/education/campus-5.webp') }}" alt="Campus" class="img-fluid rounded">

              <div id="mission-vision" class="mission-vision" data-aos="fade-up" data-aos-delay="400">
                <div class="mission">
                  <h3>{{ $mission?->title ?? 'Our Mission' }}</h3>
                  <p>{{ $mission?->description ?? '' }}</p>
                </div>

                <div class="vision">
                  <h3>{{ $vision?->title ?? 'Our Vision' }}</h3>
                  <p>{{ $vision?->description ?? '' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-12">
            <div id="core-values" class="core-values" data-aos="fade-up" data-aos-delay="500">
              <h3 class="text-center mb-4">Core Values</h3>
              <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($coreValues as $value)
                  <div class="col">
                    <div class="value-card">
                      <div class="value-icon">
                        <i class="{{ $value->icon_class ?? 'bi bi-star-fill' }}"></i>
                      </div>
                      <h4>{{ $value->title }}</h4>
                      <p>{{ $value->description }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /History Section -->

    <!-- Leadership Section -->
    <section id="leadership" class="leadership section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="intro-wrapper">
          <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="intro-image">
                <img src="{{ $leadershipSection?->image ? asset(ltrim($leadershipSection->image, '/')) : asset('College/assets/img/education/teacher-5.webp') }}" alt="School Leadership" class="img-fluid rounded-lg">
                <div class="experience-badge">
                  <span class="years">{{ $leadershipSection?->experience_years ?? '35+' }}</span>
                  <span class="text">{{ $leadershipSection?->experience_text ?? 'Years of Educational Excellence' }}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-up" data-aos-delay="300">
              <div class="intro-content">
                <span class="subtitle">{{ $leadershipSection?->subtitle ?? 'Administration & Leadership' }}</span>
                <h2 class="title">{{ $leadershipSection?->title ?? 'Inspiring Leaders Shaping Tomorrow\'s Generation' }}</h2>
                <p class="description">{{ $leadershipSection?->description ?? '' }}</p>
                <div class="highlights">
                  @foreach($leadershipHighlights as $highlight)
                    <div class="highlight-item">
                      <div class="icon-box">
                        <i class="{{ $highlight->icon_class ?? 'bi bi-star-fill' }}"></i>
                      </div>
                      <div class="content">
                        <h4>{{ $highlight->title }}</h4>
                        <p>{{ $highlight->description }}</p>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="leadership-section" data-aos="fade-up">
          <div class="section-header text-center">
            <span class="subtitle">{{ $leadershipSection?->subtitle ?? 'Our Team' }}</span>
            <h2 class="title">{{ $leadershipSection?->title ?? 'Meet Our Distinguished Leadership' }}</h2>
            <p class="description">{{ $leadershipSection?->description ?? '' }}</p>
          </div>

          <div class="row g-4">
            @foreach($leadershipMembers as $member)
              @php
                $links = $member->social_links ?? [];
                $delay = 100 + (($loop->index % 4) * 100);
              @endphp
              <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                <div class="team-card">
                  <div class="card-inner">
                    <div class="card-front">
                      <div class="member-image">
                        @if($member->image)
                          <img src="{{ asset(ltrim($member->image, '/')) }}" alt="{{ $member->name }}" class="img-fluid">
                        @endif
                      </div>
                      <div class="member-info">
                        <h4>{{ $member->name }}</h4>
                        <p>{{ $member->role }}</p>
                      </div>
                    </div>
                    <div class="card-back">
                      <h4>{{ $member->name }}</h4>
                      <p class="position">{{ $member->role }}</p>
                      <p class="bio">{{ $member->bio }}</p>
                      <div class="social-links">
                        @if(!empty($links['linkedin']))
                          <a href="{{ $links['linkedin'] }}"><i class="bi bi-linkedin"></i></a>
                        @endif
                        @if(!empty($links['twitter']))
                          <a href="{{ $links['twitter'] }}"><i class="bi bi-twitter-x"></i></a>
                        @endif
                        @if(!empty($links['email']))
                          <a href="mailto:{{ $links['email'] }}"><i class="bi bi-envelope"></i></a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>

    </section><!-- /Leadership Section -->

  </main>
@endsection
