@extends('college.layouts.app')

@section('title', 'Students Life - College Bootstrap Template')
@section('body-class', 'students-life-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Student Life</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">Students Life</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Students Life Section -->
    <section id="students-life" class="students-life section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="200">
            <img src="/College/assets/img/education/campus-1.webp" class="img-fluid rounded" alt="Campus Life">
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="student-life-intro">
              <h3>Vibrant Campus Experience</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius felis nec sem viverra, nec tincidunt felis mollis. Sed consectetur, est vel tincidunt imperdiet, magna urna bibendum magna, non fringilla dolor nunc non felis.</p>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur.</p>
              <div class="mt-4">
                <a href="#" class="btn btn-outline-primary">Explore Campus</a>
              </div>
            </div>
          </div>
        </div>

        @php
          $organizationsSection = $sections['organizations'] ?? null;
          $athleticsSection = $sections['athletics'] ?? null;
          $facilitiesSection = $sections['facilities'] ?? null;
          $supportSection = $sections['support_services'] ?? null;
          $gallerySection = $sections['gallery'] ?? null;
        @endphp

        @if($organizationsSection?->is_active !== false && $organizations->isNotEmpty())
        <div class="student-organizations mt-5 pt-4" data-aos="fade-up" data-aos-delay="200">
          <h3 class="text-center mb-4">{{ $organizationsSection->title ?? 'Organisasi & Klub Mahasiswa' }}</h3>
          @if(!empty($organizationsSection?->subtitle))
            <p class="text-center mb-4">{{ $organizationsSection->subtitle }}</p>
          @endif
          <div class="row g-4">
            @foreach($organizations as $index => $organization)
              <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ 200 + ($index * 100) }}">
                <div class="organization-card">
                  <div class="icon-box">
                    <i class="{{ $organization->icon_class ?? 'bi bi-people' }}"></i>
                  </div>
                  <h5>{{ $organization->title }}</h5>
                  <p>{{ $organization->description }}</p>
                  @if($organization->badge_text)
                    <span class="badge">{{ $organization->badge_text }}</span>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @endif

        @if($athleticsSection?->is_active !== false && $athletics->isNotEmpty())
        <div class="athletics-programs mt-5 pt-3" data-aos="fade-up" data-aos-delay="200">
          <h3 class="text-center mb-4">{{ $athleticsSection->title ?? 'Atletik & Rekreasi' }}</h3>
          @if(!empty($athleticsSection?->subtitle))
            <p class="text-center mb-4">{{ $athleticsSection->subtitle }}</p>
          @endif

          <div class="athletics-slider swiper init-swiper" data-aos="fade-up" data-aos-delay="300">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": 1,
                "spaceBetween": 30,
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "768": {
                    "slidesPerView": 2
                  },
                  "992": {
                    "slidesPerView": 3
                  }
                }
              }
            </script>
            <div class="swiper-wrapper">
              @foreach($athletics as $sport)
                <div class="swiper-slide">
                  <div class="athletics-card">
                    @if($sport->image)
                      <img src="{{ asset(ltrim($sport->image, '/')) }}" class="img-fluid" loading="lazy" alt="{{ $sport->title }}">
                    @endif
                    <div class="athletics-content">
                      <h5>{{ $sport->title }}</h5>
                      <p>{{ $sport->description }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        @endif

        @if($facilitiesSection?->is_active !== false && $facilities->isNotEmpty())
        <div class="campus-facilities mt-5 pt-3" data-aos="fade-up" data-aos-delay="200">
          <h3 class="text-center mb-4">{{ $facilitiesSection->title ?? 'Fasilitas Kampus' }}</h3>
          @if(!empty($facilitiesSection?->subtitle))
            <p class="text-center mb-4">{{ $facilitiesSection->subtitle }}</p>
          @endif

          <div class="row g-4">
            @foreach($facilities as $index => $facility)
              <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}">
                <div class="facility-card">
                  @if($facility->image)
                    <img src="{{ asset(ltrim($facility->image, '/')) }}" class="img-fluid" alt="{{ $facility->title }}">
                  @endif
                  <div class="facility-info">
                    <h5>{{ $facility->title }}</h5>
                    <p>{{ $facility->description }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @endif

        @if($supportSection?->is_active !== false && $supportServices->isNotEmpty())
        <div class="support-services mt-5 pt-3" data-aos="fade-up" data-aos-delay="200">
          <h3 class="text-center mb-4">{{ $supportSection->title ?? 'Layanan Pendukung Mahasiswa' }}</h3>
          @if(!empty($supportSection?->subtitle))
            <p class="text-center mb-4">{{ $supportSection->subtitle }}</p>
          @endif

          <div class="row g-4">
            @foreach($supportServices as $index => $service)
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}">
                <div class="service-card">
                  <div class="icon-box">
                    <i class="{{ $service->icon_class ?? 'bi bi-heart-pulse' }}"></i>
                  </div>
                  <h5>{{ $service->title }}</h5>
                  <p>{{ $service->description }}</p>
                  @if($service->link_label)
                    <a href="{{ $service->link_url ?? '#' }}" class="service-link">{{ $service->link_label }} <i class="bi bi-arrow-right"></i></a>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @endif

        @if($gallerySection?->is_active !== false && $gallery->isNotEmpty())
        <div class="student-gallery mt-5 pt-3" data-aos="fade-up" data-aos-delay="200">
          <h3 class="text-center mb-4">{{ $gallerySection->title ?? 'Galeri Kehidupan Mahasiswa' }}</h3>
          @if(!empty($gallerySection?->subtitle))
            <p class="text-center mb-4">{{ $gallerySection->subtitle }}</p>
          @endif

          <div class="row g-3">
            @foreach($gallery as $index => $photo)
              <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ 100 + ($index * 100) }}">
                <a href="{{ asset(ltrim($photo->image, '/')) }}" class="gallery-item glightbox">
                  <img src="{{ asset(ltrim($photo->image, '/')) }}" class="img-fluid" loading="lazy" alt="{{ $photo->title }}">
                  <div class="gallery-overlay">
                    <i class="bi bi-plus-circle"></i>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
        @endif

        <div class="cta-block mt-5 pt-3" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right" data-aos-delay="300">
              <h3>Ready to Experience Student Life?</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius felis nec sem viverra, nec tincidunt felis mollis.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="400">
              <a href="#" class="btn btn-primary">Schedule a Visit</a>
              <a href="#" class="btn btn-outline-primary ms-2">Contact Us</a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Students Life Section -->

  </main>
@endsection

