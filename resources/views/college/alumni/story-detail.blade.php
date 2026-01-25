@extends('college.layouts.app')

@section('title', $story->title . ' - Alumni Stories')

@section('main')
    <main class="main">

        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Alumni Story</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('college.index') }}">Home</a></li>
                        <li><a href="{{ route('college.alumni.index') }}">Alumni</a></li>
                        <li class="current">{{ Str::limit($story->title, 30) }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <article class="blog-details">
                            @if ($story->featured_image)
                                <div class="post-img mb-4">
                                    <img src="{{ asset($story->featured_image) }}" alt=""
                                        class="img-fluid rounded w-100">
                                </div>
                            @endif

                            <h2 class="title">{{ $story->title }}</h2>

                            <div class="meta-top d-flex align-items-center mb-4">
                                <div class="d-flex align-items-center me-4">
                                    <i class="bi bi-person"></i> <span class="ps-2">{{ $story->alumni_name }} (Class of
                                        {{ $story->graduation_year }})</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock"></i> <span
                                        class="ps-2">{{ $story->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <div class="content">
                                {!! clean($story->content) !!}
                            </div>

                        </article>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
