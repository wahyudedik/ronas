@extends('college.layouts.app')

@section('title', 'Campus Facilities - College Bootstrap Template')
@section('body-class', 'campus-facilities-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Campus &amp; Facilities</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">Campus Facilities</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Campus Facilities Section -->
    <section id="campus-facilities" class="campus-facilities section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Hero Introduction Row -->
        <div class="hero-intro">
          <div class="row g-0 align-items-center">
            <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
              <div class="content-wrapper">
                <div class="badge-highlight">Campus Excellence</div>
                <h1>Discover Our Modern Campus Facilities</h1>
                <p class="lead-text">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; sed viverra mattis dui vel bibendum. Mauris vitae nunc eget lorem consectetur vehicula.</p>
                <div class="feature-highlights">
                  <div class="highlight-item">
                    <i class="bi bi-award"></i>
                    <div>
                      <span class="number">95+</span>
                      <span class="label">Modern Buildings</span>
                    </div>
                  </div>
                  <div class="highlight-item">
                    <i class="bi bi-geo-alt"></i>
                    <div>
                      <span class="number">200</span>
                      <span class="label">Acre Campus</span>
                    </div>
                  </div>
                  <div class="highlight-item">
                    <i class="bi bi-people"></i>
                    <div>
                      <span class="number">25k+</span>
                      <span class="label">Students</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
              <div class="hero-visual">
                <div class="image-stack">
                  <img src="/College/assets/img/education/campus-6.webp" alt="Campus View" class="img-fluid primary-img">
                  <div class="floating-card">
                    <i class="bi bi-mortarboard"></i>
                    <span>Academic Excellence</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Facilities Categories Grid -->
        @if($categories->isNotEmpty())
          <div class="facilities-grid" data-aos="fade-up" data-aos-delay="200">
            @foreach($categories as $index => $category)
              <div class="category-card {{ $category->theme }}" data-aos="zoom-in" data-aos-delay="{{ 100 + ($index * 100) }}">
                <div class="card-header">
                  <div class="icon-wrapper">
                    <i class="{{ $category->icon_class ?? 'bi bi-building' }}"></i>
                  </div>
                  <h3>{{ $category->name }}</h3>
                </div>
                <div class="card-content">
                  <div class="facility-image">
                    @if($category->image)
                      <img src="{{ asset(ltrim($category->image, '/')) }}" alt="{{ $category->name }}" class="img-fluid">
                    @endif
                  </div>
                  @if($category->items->isNotEmpty())
                    <div class="facility-list">
                      @foreach($category->items as $item)
                        <div class="facility-item">
                          <i class="{{ $item->icon_class ?? 'bi bi-check2-circle' }}"></i>
                          <span>{{ $item->label }}</span>
                        </div>
                      @endforeach
                    </div>
                  @endif
                </div>
                <div class="card-footer">
                  <a href="{{ $category->button_url ?? '#' }}" class="explore-btn">
                    {{ $category->button_label ?? 'Explore' }} <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @endif

        <!-- Interactive Campus Tour -->
        @if($virtualTour)
          <div class="campus-tour-section" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
              <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="tour-content">
                  <h2>{{ $virtualTour->title ?? 'Take a Virtual Campus Tour' }}</h2>
                  <p>{{ $virtualTour->description }}</p>
                  @if($virtualTourFeatures->isNotEmpty())
                    <div class="tour-features">
                      @foreach($virtualTourFeatures as $feature)
                        <div class="tour-feature">
                          <i class="{{ $feature->icon_class ?? 'bi bi-info-circle' }}"></i>
                          <div>
                            <strong>{{ $feature->title }}</strong>
                            <p>{{ $feature->description }}</p>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @endif
                  <div class="tour-actions">
                    @if($virtualTour->primary_label)
                      <a href="{{ $virtualTour->primary_url ?? '#' }}" class="btn-primary">{{ $virtualTour->primary_label }}</a>
                    @endif
                    @if($virtualTour->secondary_label)
                      <a href="{{ $virtualTour->secondary_url ?? '#' }}" class="btn-outline">{{ $virtualTour->secondary_label }}</a>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="tour-visual">
                  <div class="video-container">
                    <video autoplay="" muted="" loop="">
                      <source src="{{ $virtualTour->video_url ? asset(ltrim($virtualTour->video_url, '/')) : '' }}" type="video/mp4">
                    </video>
                    <div class="play-overlay">
                      <button class="play-btn">
                        <i class="bi bi-play-fill"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif

        <!-- Campus Highlights Carousel -->
        @if($highlights->isNotEmpty())
          <div class="highlights-carousel" data-aos="fade-up" data-aos-delay="200">
            <div class="section-header">
              <h2>Campus Highlights</h2>
              <p>Discover the spaces and services that make our campus special.</p>
            </div>

            <div class="campus-slider swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 800,
                  "autoplay": {
                    "delay": 4000
                  },
                  "slidesPerView": 1,
                  "spaceBetween": 30,
                  "navigation": {
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev"
                  },
                  "breakpoints": {
                    "768": {
                      "slidesPerView": 2
                    },
                    "1024": {
                      "slidesPerView": 3
                    }
                  }
                }
              </script>
              <div class="swiper-wrapper">
                @foreach($highlights as $highlight)
                  <div class="swiper-slide">
                    <div class="highlight-card">
                      <div class="card-image">
                        @if($highlight->image)
                          <img src="{{ asset(ltrim($highlight->image, '/')) }}" alt="{{ $highlight->title }}" class="img-fluid" loading="lazy">
                        @endif
                        @if($highlight->category_label)
                          <div class="image-overlay">
                            <span class="category-tag">{{ $highlight->category_label }}</span>
                          </div>
                        @endif
                      </div>
                      <div class="card-body">
                        <h4>{{ $highlight->title }}</h4>
                        <p>{{ $highlight->description }}</p>
                        <div class="card-stats">
                          @if($highlight->stat_one_label)
                            <div class="stat">
                              <i class="{{ $highlight->stat_one_icon ?? 'bi bi-star' }}"></i>
                              <span>{{ $highlight->stat_one_label }}</span>
                            </div>
                          @endif
                          @if($highlight->stat_two_label)
                            <div class="stat">
                              <i class="{{ $highlight->stat_two_icon ?? 'bi bi-star' }}"></i>
                              <span>{{ $highlight->stat_two_label }}</span>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>
        @endif

        <!-- Campus Map Integration -->
        @if($mapSetting)
          <div class="map-integration" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
              <div class="col-lg-4" data-aos="fade-right" data-aos-delay="200">
                <div class="map-sidebar">
                  <h3>{{ $mapSetting->title ?? 'Navigate Our Campus' }}</h3>
                  <p>{{ $mapSetting->description }}</p>

                  @if($mapCategories->isNotEmpty())
                    <div class="location-categories">
                      @foreach($mapCategories as $index => $category)
                        <div class="category-filter {{ $index === 0 ? 'active' : '' }}" data-category="{{ $category->key ?? 'all' }}">
                          <i class="{{ $category->icon_class ?? 'bi bi-grid' }}"></i>
                          <span>{{ $category->name }}</span>
                        </div>
                      @endforeach
                    </div>
                  @endif

                  @if($mapActions->isNotEmpty())
                    <div class="map-actions">
                      @foreach($mapActions as $action)
                        <a href="{{ $action->url ?? '#' }}" class="action-link">
                          <i class="{{ $action->icon_class ?? 'bi bi-link-45deg' }}"></i>
                          {{ $action->label }}
                        </a>
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
              <div class="col-lg-8" data-aos="fade-left" data-aos-delay="300">
                <div class="map-embed">
                  <div class="ratio ratio-4x3">
                    <iframe src="{{ $mapSetting->embed_url ?? '' }}" allowfullscreen="" loading="lazy"></iframe>
                  </div>
                  <div class="map-overlay-info">
                    <div class="info-card">
                      <h5>{{ $mapSetting->location_title ?? 'Main Campus' }}</h5>
                      <p>{{ $mapSetting->location_address }}</p>
                      <div class="quick-stats">
                        @if($mapSetting->stat_one_label)
                          <span><i class="{{ $mapSetting->stat_one_icon ?? 'bi bi-geo-alt' }}"></i> {{ $mapSetting->stat_one_label }}</span>
                        @endif
                        @if($mapSetting->stat_two_label)
                          <span><i class="{{ $mapSetting->stat_two_icon ?? 'bi bi-building' }}"></i> {{ $mapSetting->stat_two_label }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif

      </div>

    </section><!-- /Campus Facilities Section -->

  </main>
@endsection
