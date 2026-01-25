@extends('college.layouts.app')

@section('title', $event->event_name . ' - Alumni Events')

@section('main')
<main class="main">

    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Event Details</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li><a href="{{ route('college.alumni.index') }}">Alumni</a></li>
            <li><a href="{{ route('college.alumni.events') }}">Events</a></li>
            <li class="current">{{ Str::limit($event->event_name, 30) }}</li>
          </ol>
        </nav>
      </div>
    </div>

    <section class="section">
      <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($event->featured_image)
                    <img src="{{ asset($event->featured_image) }}" alt="" class="img-fluid rounded mb-4 w-100">
                @endif
                
                <h2>{{ $event->event_name }}</h2>
                
                <div class="mt-4">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Event Info</h5>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="bi bi-calendar me-2 text-primary"></i> <strong>Date:</strong> {{ $event->date->format('M d, Y') }}</li>
                            <li class="mb-2"><i class="bi bi-clock me-2 text-primary"></i> <strong>Time:</strong> {{ $event->date->format('h:i A') }}</li>
                            <li class="mb-2"><i class="bi bi-geo-alt me-2 text-primary"></i> <strong>Location:</strong> {{ $event->location }}</li>
                        </ul>
                        
                        @if($event->registration_link)
                            <div class="d-grid">
                                <a href="{{ $event->registration_link }}" class="btn btn-primary" target="_blank">Register Now</a>
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                No registration required or link not available.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

</main>
@endsection
