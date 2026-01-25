@extends('college.layouts.app')

@section('title', 'Alumni Events')

@section('main')
<main class="main">

    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Alumni Events</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li><a href="{{ route('college.alumni.index') }}">Alumni</a></li>
            <li class="current">Events</li>
          </ol>
        </nav>
      </div>
    </div>

    <section class="section">
      <div class="container">
        <div class="row gy-4">
            @forelse($events as $event)
            <div class="col-xl-4 col-md-6">
              <div class="card h-100 shadow-sm border-0">
                @if($event->featured_image)
                    <img src="{{ asset($event->featured_image) }}" class="card-img-top" alt="{{ $event->event_name }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-calendar-event fs-1"></i>
                    </div>
                @endif
                <div class="card-body">
                    <div class="text-muted small mb-2">
                        <i class="bi bi-calendar"></i> {{ $event->date->format('M d, Y h:i A') }}
                    </div>
                    <h5 class="card-title"><a href="{{ route('college.alumni.event-detail', $event) }}" class="text-dark text-decoration-none">{{ $event->event_name }}</a></h5>
                    <p class="card-text text-secondary">{{ Str::limit($event->description, 100) }}</p>
                    <a href="{{ route('college.alumni.event-detail', $event) }}" class="btn btn-outline-primary btn-sm stretched-link">View Details</a>
                </div>
              </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No upcoming events at the moment.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-4">
            {{ $events->links() }}
        </div>
      </div>
    </section>

</main>
@endsection
