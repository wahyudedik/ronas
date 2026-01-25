@extends('college.layouts.app')

@section('title', $page->title . ' - SMKS Roudlotun Nasyiin')
@section('body-class', 'legal-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{ $page->title }}</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">{{ $page->title }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Content Section -->
    <section id="legal-content" class="legal-content section">

      <div class="container" data-aos="fade-up">
        <div class="legal-wrapper">
          @if($page->published_at)
            <div class="last-updated mb-4 text-muted">
                Last Updated: {{ $page->published_at->format('F d, Y') }}
            </div>
          @endif
          
          <div class="content-body">
              {!! $page->content !!}
          </div>
        </div>
      </div>

    </section>

</main>
@endsection
