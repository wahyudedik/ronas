@extends('college.layouts.app')

@section('title', $event->title . ' - Event Details')
@section('body-class', 'event-details-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{ $event->title }}</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li><a href="{{ route('college.events') }}">Events</a></li>
            <li class="current">{{ Str::limit($event->title, 30) }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Event Section -->
    <section id="event" class="event section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
          <div class="col-lg-8">
            @if($event->image)
              <div class="event-image mb-4" data-aos="fade-up">
                <img src="{{ asset(ltrim($event->image, '/')) }}" alt="{{ $event->title }}" class="img-fluid rounded">
              </div>
            @endif

            <div class="event-meta mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="row g-3">
                @if($event->event_date)
                  <div class="col-md-4">
                    <div class="meta-item">
                      <i class="bi bi-calendar-date"></i>
                      <span>{{ $event->event_date->format('m/d/Y') }}</span>
                    </div>
                  </div>
                @endif
                @if($event->event_time)
                  <div class="col-md-4">
                    <div class="meta-item">
                      <i class="bi bi-clock"></i>
                      <span>{{ $event->event_time }}</span>
                    </div>
                  </div>
                @endif
                @if($event->location)
                  <div class="col-md-4">
                    <div class="meta-item">
                      <i class="bi bi-geo-alt"></i>
                      <span>{{ $event->location }}</span>
                    </div>
                  </div>
                @endif
              </div>
            </div>

            <div class="event-content" data-aos="fade-up" data-aos-delay="200">
              <h2>{{ $event->title }}</h2>
              
              @if($event->category)
                <p class="mb-3">
                  <span class="badge bg-primary">{{ $event->category }}</span>
                </p>
              @endif

              @if($event->description)
                <div class="event-description">
                  {!! nl2br(e($event->description)) !!}
                </div>
              @endif

              @if($event->participants)
                <div class="mt-4">
                  <h4>Participants</h4>
                  <p>{{ $event->participants }}</p>
                </div>
              @endif

              @if($event->registration_url)
                <div class="mt-4">
                  <a href="{{ $event->registration_url }}" class="btn btn-primary" target="_blank">Register Now</a>
                </div>
              @endif
            </div>

            @if($relatedEvents->count() > 0)
              <div class="related-events mt-5" data-aos="fade-up" data-aos-delay="300">
                <h3>Related Events</h3>
                <div class="row g-4 mt-2">
                  @foreach($relatedEvents as $related)
                    <div class="col-md-6">
                      <div class="related-event-item">
                        @if($related->event_date)
                          <div class="related-event-date">
                            <span class="day">{{ $related->event_date->format('d') }}</span>
                            <span class="month">{{ $related->event_date->format('M') }}</span>
                          </div>
                        @endif
                        <div class="related-event-info">
                          <h4><a href="{{ route('college.events.show', $related) }}">{{ $related->title }}</a></h4>
                          @if($related->location)
                            <p><i class="bi bi-geo-alt"></i> {{ $related->location }}</p>
                          @endif
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>

          <div class="col-lg-4">
            <div class="event-sidebar">
              @if($event->registration_url)
                <div class="sidebar-widget registration-form" data-aos="fade-left" data-aos-delay="200">
                  <h3>Register for this Event</h3>
                  <div class="d-grid">
                    <a href="{{ $event->registration_url }}" class="btn btn-register" target="_blank">Register Now</a>
                  </div>
                </div>
              @endif

              <div class="sidebar-widget event-info" data-aos="fade-left" data-aos-delay="300">
                <h3>Event Information</h3>
                <div class="event-details-list">
                  @if($event->event_date)
                    <div class="detail-item">
                      <i class="bi bi-calendar"></i>
                      <strong>Date:</strong> {{ $event->event_date->format('F d, Y') }}
                    </div>
                  @endif
                  @if($event->event_time)
                    <div class="detail-item">
                      <i class="bi bi-clock"></i>
                      <strong>Time:</strong> {{ $event->event_time }}
                    </div>
                  @endif
                  @if($event->location)
                    <div class="detail-item">
                      <i class="bi bi-geo-alt"></i>
                      <strong>Location:</strong> {{ $event->location }}
                    </div>
                  @endif
                  @if($event->category)
                    <div class="detail-item">
                      <i class="bi bi-tag"></i>
                      <strong>Category:</strong> {{ $event->category }}
                    </div>
                  @endif
                  @if($event->participants)
                    <div class="detail-item">
                      <i class="bi bi-people"></i>
                      <strong>Participants:</strong> {{ $event->participants }}
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</main>
@endsection
