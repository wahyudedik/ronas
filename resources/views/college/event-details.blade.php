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
                        @if ($event->image)
                            <div class="event-image mb-4" data-aos="fade-up">
                                <img src="{{ asset(ltrim($event->image, '/')) }}" alt="{{ $event->title }}"
                                    class="img-fluid rounded">
                            </div>
                        @endif

                        <div class="event-meta mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="row g-3">
                                @if ($event->start_date)
                                    <div class="col-md-4">
                                        <div class="meta-item">
                                            <i class="bi bi-calendar-date"></i>
                                            <span>{{ $event->start_date->format('m/d/Y') }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if ($event->start_time)
                                    <div class="col-md-4">
                                        <div class="meta-item">
                                            <i class="bi bi-clock"></i>
                                            <span>{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if ($event->venue)
                                    <div class="col-md-4">
                                        <div class="meta-item">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>{{ $event->venue }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="event-content" data-aos="fade-up" data-aos-delay="200">
                            <h2>{{ $event->title }}</h2>

                            @if ($event->category)
                                <p class="mb-3">
                                    <span class="badge bg-primary">{{ $event->category->name }}</span>
                                    <span class="badge bg-secondary">{{ ucfirst($event->status) }}</span>
                                </p>
                            @endif

                            @if ($event->description)
                                <div class="event-description">
                                    {!! nl2br(e($event->description)) !!}
                                </div>
                            @endif

                            @if ($event->capacity)
                                <div class="mt-4">
                                    <h4>Event Details</h4>
                                    <ul class="list-unstyled">
                                        <li><strong>Capacity:</strong> {{ $event->capacity }} Attendees</li>
                                        @if ($event->registration_deadline)
                                            <li><strong>Registration Deadline:</strong>
                                                {{ $event->registration_deadline->format('M d, Y h:i A') }}</li>
                                        @endif
                                    </ul>
                                </div>
                            @endif

                            @if ($event->registration_url && $event->status === 'upcoming')
                                <div class="mt-4">
                                    <a href="{{ $event->registration_url }}" class="btn btn-primary"
                                        target="_blank">Register Now</a>
                                </div>
                            @endif
                        </div>

                        @if ($relatedEvents->count() > 0)
                            <div class="related-events mt-5" data-aos="fade-up" data-aos-delay="300">
                                <h3>Related Events</h3>
                                <div class="row g-4 mt-2">
                                    @foreach ($relatedEvents as $related)
                                        <div class="col-md-6">
                                            <div class="related-event-item">
                                                @if ($related->start_date)
                                                    <div class="related-event-date">
                                                        <span class="day">{{ $related->start_date->format('d') }}</span>
                                                        <span class="month">{{ $related->start_date->format('M') }}</span>
                                                    </div>
                                                @endif
                                                <div class="related-event-info">
                                                    <h4><a
                                                            href="{{ route('college.events.show', $related) }}">{{ $related->title }}</a>
                                                    </h4>
                                                    @if ($related->venue)
                                                        <p><i class="bi bi-geo-alt"></i> {{ $related->venue }}</p>
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
                            @if ($event->registration_url && $event->status === 'upcoming')
                                <div class="sidebar-widget registration-form" data-aos="fade-left" data-aos-delay="200">
                                    <h3>Register for this Event</h3>
                                    <div class="d-grid">
                                        <a href="{{ $event->registration_url }}" class="btn btn-register"
                                            target="_blank">Register Now</a>
                                    </div>
                                </div>
                            @elseif($event->status === 'upcoming')
                                <div class="sidebar-widget registration-form" data-aos="fade-left" data-aos-delay="200">
                                    <h3>Register for this Event</h3>

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form action="{{ route('college.events.register', $event) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', Auth::user()?->name) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', Auth::user()?->email) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone') }}">
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Register Now</button>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            <div class="sidebar-widget event-info" data-aos="fade-left" data-aos-delay="300">
                                <h3>Event Information</h3>
                                <div class="event-details-list">
                                    @if ($event->start_date)
                                        <div class="detail-item">
                                            <i class="bi bi-calendar"></i>
                                            <strong>Date:</strong> {{ $event->start_date->format('F d, Y') }}
                                        </div>
                                    @endif
                                    @if ($event->start_time)
                                        <div class="detail-item">
                                            <i class="bi bi-clock"></i>
                                            <strong>Time:</strong>
                                            {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}
                                            @if ($event->end_time)
                                                - {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                            @endif
                                        </div>
                                    @endif
                                    @if ($event->venue)
                                        <div class="detail-item">
                                            <i class="bi bi-geo-alt"></i>
                                            <strong>Venue:</strong> {{ $event->venue }}
                                        </div>
                                    @endif
                                    @if ($event->address)
                                        <div class="detail-item">
                                            <i class="bi bi-map"></i>
                                            <strong>Address:</strong> {{ $event->address }}
                                        </div>
                                    @endif
                                    @if ($event->category)
                                        <div class="detail-item">
                                            <i class="bi bi-tag"></i>
                                            <strong>Category:</strong> {{ $event->category->name }}
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
