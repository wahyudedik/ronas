@extends('college.layouts.app')

@section('title', 'Alumni Network')
@section('body-class', 'alumni-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Alumni Network</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">Alumni</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Success Stories Section -->
    <section id="success-stories" class="testimonials section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Success Stories</h2>
        <p>Inspiring journeys of our graduates making a difference in the world.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": { "delay": 5000 },
              "slidesPerView": "auto",
              "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
              "breakpoints": {
                "320": { "slidesPerView": 1, "spaceBetween": 40 },
                "1200": { "slidesPerView": 3, "spaceBetween": 20 }
              }
            }
          </script>
          <div class="swiper-wrapper">
            @foreach($featuredStories as $story)
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="d-flex align-items-center mb-3">
                     @if($story->featured_image)
                        <img src="{{ asset($story->featured_image) }}" class="testimonial-img flex-shrink-0" alt="">
                     @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($story->alumni_name) }}" class="testimonial-img flex-shrink-0" alt="">
                     @endif
                     <div class="ms-3">
                        <h3>{{ $story->alumni_name }}</h3>
                        <h4>Class of {{ $story->graduation_year }}</h4>
                     </div>
                  </div>
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>{{ Str::limit(strip_tags($story->content), 150) }}</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <div class="mt-3 text-end">
                      <a href="{{ route('college.alumni.story-detail', $story) }}" class="read-more">Read Full Story <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('college.alumni.submit-story') }}" class="btn btn-primary">Share Your Story</a>
        </div>
      </div>
    </section>

    <!-- Upcoming Events Section -->
    <section id="alumni-events" class="events section light-background">
      <div class="container section-title" data-aos="fade-up">
        <h2>Upcoming Events</h2>
        <p>Reconnect with fellow alumni at our upcoming gatherings.</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          @foreach($upcomingEvents as $event)
            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="event-item position-relative">
                <div class="event-img">
                    @if($event->featured_image)
                        <img src="{{ asset($event->featured_image) }}" class="img-fluid" alt="{{ $event->event_name }}">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-calendar-event fs-1"></i>
                        </div>
                    @endif
                </div>
                <div class="event-content d-flex flex-column justify-content-center h-100">
                    <div class="meta px-4">
                        <span class="d-block"><i class="bi bi-calendar"></i> {{ $event->date->format('M d, Y') }}</span>
                        <span class="d-block"><i class="bi bi-clock"></i> {{ $event->date->format('h:i A') }}</span>
                    </div>
                    <h3 class="px-4"><a href="{{ route('college.alumni.event-detail', $event) }}">{{ $event->event_name }}</a></h3>
                    <div class="px-4 pb-4">
                        <p>{{ Str::limit($event->description, 100) }}</p>
                        <a href="{{ route('college.alumni.event-detail', $event) }}" class="read-more stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="text-center mt-4">
             <a href="{{ route('college.alumni.events') }}" class="btn btn-outline-primary">View All Events</a>
        </div>
      </div>
    </section>

    <!-- Get Involved Section -->
    <section id="get-involved" class="services section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Get Involved</h2>
        <p>Ways to give back to the community and support current students.</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          @foreach($involvedOptions as $option)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="bi bi-people-fill"></i>
                </div>
                <h3>{{ $option->title }}</h3>
                <p>{{ $option->description }}</p>
                <div class="mt-3">
                    <span class="badge bg-info text-dark">{{ $option->type }}</span>
                </div>
                @if($option->contact_info)
                    <div class="mt-2 text-muted small">
                        <i class="bi bi-envelope"></i> {{ $option->contact_info }}
                    </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Donation Campaigns Section -->
    <section id="donations" class="donations section light-background">
      <div class="container section-title" data-aos="fade-up">
        <h2>Support Our Vision</h2>
        <p>Your contributions help us build a better future for the next generation.</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          @foreach($campaigns as $campaign)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="card h-100 shadow-sm">
                <div class="row g-0 h-100">
                    <div class="col-md-4">
                         @if($campaign->featured_image)
                            <img src="{{ asset($campaign->featured_image) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $campaign->campaign_name }}">
                        @else
                            <div class="bg-primary text-white d-flex align-items-center justify-content-center h-100">
                                <i class="bi bi-heart-fill fs-1"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $campaign->campaign_name }}</h5>
                            <p class="card-text">{{ Str::limit($campaign->description, 120) }}</p>
                            
                            @php
                                $percentage = $campaign->target_amount > 0 ? ($campaign->current_amount / $campaign->target_amount) * 100 : 0;
                            @endphp
                            
                            <div class="progress mb-2" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mb-3">
                                <span>Raised: ${{ number_format($campaign->current_amount) }}</span>
                                <span>Goal: ${{ number_format($campaign->target_amount) }}</span>
                            </div>
                            
                            <a href="{{ route('college.alumni.donate', $campaign) }}" class="btn btn-primary btn-sm">Donate Now</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

</main>
@endsection
