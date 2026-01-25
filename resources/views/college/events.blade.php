@extends('college.layouts.app')

@section('title', 'Events - College Bootstrap Template')
@section('body-class', 'events-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Events</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">Events</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Events Extended Section -->
    <section id="events-extended" class="events-extended section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
          <div class="col-lg-8">
            <!-- Events List -->
            <div class="events-list">
              @forelse($events as $index => $event)
                <div class="event-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                  @if($event->start_date)
                    <div class="event-date">
                      <span class="day">{{ $event->start_date->format('d') }}</span>
                      <span class="month">{{ $event->start_date->format('M') }}</span>
                    </div>
                  @endif
                  <div class="event-content">
                    <h3 class="event-title">{{ $event->title }}</h3>
                    <div class="event-meta">
                      @if($event->start_time)
                        <span><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</span>
                      @endif
                      @if($event->venue)
                        <span><i class="bi bi-geo-alt"></i> {{ $event->venue }}</span>
                      @endif
                    </div>
                    @if($event->category)
                      <span class="badge bg-light text-dark mb-2">{{ $event->category->name }}</span>
                    @endif
                    @if($event->description)
                      <p class="event-description">{{ Str::limit($event->description, 150) }}</p>
                    @endif
                    <a href="{{ route('college.events.show', $event) }}" class="btn-event-details">Learn More <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              @empty
                <div class="event-item">
                  <div class="event-content">
                    <p class="text-center">No events available at the moment.</p>
                  </div>
                </div>
              @endforelse

              <!-- Pagination -->
              @if($events->hasPages())
                <div class="events-pagination mt-4" data-aos="fade-up">
                  {{ $events->links() }}
                </div>
              @endif
            </div>
          </div>

          <div class="col-lg-4">
            <!-- Sidebar -->
            <div class="events-sidebar">
              <!-- Search Form -->
              <div class="sidebar-item search-form" data-aos="fade-up">
                <h4>Search Events</h4>
                <form action="{{ route('college.events') }}" method="GET">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Events..." value="{{ request('search') }}">
                    <button class="btn" type="submit"><i class="bi bi-search"></i></button>
                  </div>
                </form>
              </div>

              <!-- View Filter -->
              <div class="sidebar-item categories" data-aos="fade-up" data-aos-delay="50">
                <h4>View</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route('college.events') }}" class="{{ !request('view') ? 'fw-bold' : '' }}">Upcoming Events</a></li>
                    <li><a href="{{ route('college.events', ['view' => 'past']) }}" class="{{ request('view') == 'past' ? 'fw-bold' : '' }}">Past Events</a></li>
                </ul>
              </div>

              <!-- Categories -->
              @if($categories->count() > 0)
                <div class="sidebar-item categories" data-aos="fade-up" data-aos-delay="100">
                  <h4>Event Categories</h4>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('college.events') }}">All Events</a></li>
                    @foreach($categories as $cat)
                      <li><a href="{{ route('college.events') }}?category={{ $cat->slug }}">{{ $cat->name }}</a></li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <!-- Upcoming Events Widget -->
              @php
                $upcomingEvents = \App\Models\Event::upcoming()
                  ->take(3)
                  ->get();
              @endphp
              @if($upcomingEvents->count() > 0)
                <div class="sidebar-item upcoming-events" data-aos="fade-up" data-aos-delay="200">
                  <h4>Upcoming Featured Events</h4>
                  @foreach($upcomingEvents as $upcoming)
                    <div class="featured-event mb-3">
                      @if($upcoming->image)
                        <img src="{{ asset(ltrim($upcoming->image, '/')) }}" alt="{{ $upcoming->title }}" class="img-fluid">
                      @endif
                      <div class="featured-event-details">
                        <h5>{{ $upcoming->title }}</h5>
                        @if($upcoming->start_date)
                          <span class="event-date"><i class="bi bi-calendar"></i> {{ $upcoming->start_date->format('M d, Y') }}</span>
                        @endif
                        <a href="{{ route('college.events.show', $upcoming) }}" class="btn-sm btn-register">View Details</a>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

</main>
@endsection
