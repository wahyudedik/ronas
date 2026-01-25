@extends('college.layouts.app')

@section('title', 'News - College Bootstrap Template')
@section('body-class', 'news-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">News</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">News</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- News Hero Section -->
    <section id="news-hero" class="news-hero section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
          <!-- Main Content Area -->
          <div class="col-lg-8">
            @if($news->count() > 0)
              @php
                $featuredNews = $news->first();
                $otherNews = $news->skip(1)->take(2);
              @endphp
              <!-- Featured Article -->
              <article class="featured-post position-relative mb-4" data-aos="fade-up">
                @if($featuredNews->image)
                  <img src="{{ asset(ltrim($featuredNews->image, '/')) }}" alt="{{ $featuredNews->title }}" class="img-fluid">
                @else
                  <img src="/College/assets/img/blog/blog-hero-9.webp" alt="Featured post" class="img-fluid">
                @endif
                <div class="post-overlay">
                  <div class="post-content">
                    <div class="post-meta">
                      @if($featuredNews->category)
                        <span class="category">{{ $featuredNews->category->name }}</span>
                      @endif
                      @if($featuredNews->published_at)
                        <span class="date">{{ $featuredNews->published_at->format('m/d/Y') }}</span>
                      @endif
                    </div>
                    <h2 class="post-title">
                      <a href="{{ route('college.news.show', $featuredNews) }}">{{ $featuredNews->title }}</a>
                    </h2>
                    @if($featuredNews->excerpt)
                      <p class="post-excerpt">{{ $featuredNews->excerpt }}</p>
                    @endif
                    <div class="post-author">
                      <span>by</span>
                      <a href="#">{{ $featuredNews->author->name ?? 'Admin' }}</a>
                    </div>
                  </div>
                </div>
              </article>

              <!-- Secondary Articles -->
              @if($otherNews->count() > 0)
                <div class="row g-4">
                  @foreach($otherNews as $index => $item)
                    <div class="col-md-6">
                      <article class="secondary-post" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="post-image">
                          @if($item->image)
                            <img src="{{ asset(ltrim($item->image, '/')) }}" alt="{{ $item->title }}" class="img-fluid">
                          @else
                            <img src="/College/assets/img/blog/blog-post-{{ $index + 1 }}.webp" alt="Post" class="img-fluid">
                          @endif
                        </div>
                        <div class="post-content">
                          <div class="post-meta">
                            @if($item->category)
                              <span class="category">{{ $item->category->name }}</span>
                            @endif
                            @if($item->published_at)
                              <span class="date">{{ $item->published_at->format('m/d/Y') }}</span>
                            @endif
                          </div>
                          <h3 class="post-title">
                            <a href="{{ route('college.news.show', $item) }}">{{ $item->title }}</a>
                          </h3>
                          <div class="post-author">
                              <span>by</span>
                              <a href="#">{{ $item->author->name ?? 'Admin' }}</a>
                          </div>
                        </div>
                      </article>
                    </div>
                  @endforeach
                </div>
              @endif
            @endif
          </div><!-- End Main Content Area -->

          <!-- Sidebar -->
          <div class="col-lg-4">
            <!-- Categories Widget -->
            <div class="news-tabs mb-4" data-aos="fade-up" data-aos-delay="150">
                <h4 class="mb-3">Categories</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('college.news') }}">All News</a>
                    </li>
                    @foreach($categories as $cat)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('college.news') }}?category={{ $cat->slug }}">{{ $cat->name }}</a>
                            <span class="badge bg-primary rounded-pill">{{ $cat->news_count ?? '' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="news-tabs" data-aos="fade-up" data-aos-delay="200">
              <h4 class="mb-3">Latest News</h4>
              @if($news->count() > 0)
                @foreach($news->take(5) as $item)
                  <article class="tab-post mb-3">
                    <div class="row g-0 align-items-center">
                      @if($item->image)
                        <div class="col-4">
                          <img src="{{ asset(ltrim($item->image, '/')) }}" alt="{{ $item->title }}" class="img-fluid">
                        </div>
                      @endif
                      <div class="{{ $item->image ? 'col-8' : 'col-12' }}">
                        <div class="post-content">
                          @if($item->category)
                            <span class="category">{{ $item->category->name }}</span>
                          @endif
                          <h4 class="post-title">
                            <a href="{{ route('college.news.show', $item) }}">{{ Str::limit($item->title, 50) }}</a>
                          </h4>
                          <div class="post-author">by <a href="#">{{ $item->author->name ?? 'Admin' }}</a></div>
                        </div>
                      </div>
                    </div>
                  </article>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </section><!-- /News Hero Section -->

    <!-- News Posts Section -->
    <section id="news-posts" class="news-posts section">
      <div class="container">
        <div class="row gy-4">
          @forelse($news as $index => $item)
            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3 + 1) * 100 }}">
              <article>
                <div class="post-img">
                  @if($item->image)
                    <img src="{{ asset(ltrim($item->image, '/')) }}" alt="{{ $item->title }}" class="img-fluid">
                  @else
                    <img src="/College/assets/img/blog/blog-post-{{ ($index % 9) + 1 }}.webp" alt="" class="img-fluid">
                  @endif
                </div>

                @if($item->category)
                  <p class="post-category">{{ $item->category->name }}</p>
                @endif

                <h2 class="title">
                  <a href="{{ route('college.news.show', $item) }}">{{ $item->title }}</a>
                </h2>

                <div class="d-flex align-items-center">
                  @if($item->author_image)
                    <img src="{{ asset(ltrim($item->author_image, '/')) }}" alt="{{ $item->author->name ?? 'Admin' }}" class="img-fluid post-author-img flex-shrink-0">
                  @else
                    <img src="/College/assets/img/person/person-f-{{ ($index % 3) + 12 }}.webp" alt="" class="img-fluid post-author-img flex-shrink-0">
                  @endif
                  <div class="post-meta">
                    <p class="post-author">{{ $item->author->name ?? 'Admin' }}</p>
                    @if($item->published_at)
                      <p class="post-date">
                        <time datetime="{{ $item->published_at->format('Y-m-d') }}">{{ $item->published_at->format('M d, Y') }}</time>
                      </p>
                    @endif
                  </div>
                </div>
              </article>
            </div>
          @empty
            <div class="col-12">
              <p class="text-center">No news available at the moment.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section><!-- /News Posts Section -->

    <!-- Pagination Section -->
    @if($news->hasPages())
      <section id="pagination-2" class="pagination-2 section">
        <div class="container">
          <nav class="d-flex justify-content-center" aria-label="Page navigation">
            {{ $news->links() }}
          </nav>
        </div>
      </section>
    @endif

</main>
@endsection
