@extends('college.layouts.app')

@section('title', $news->title . ' - News')
@section('body-class', 'news-details-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{ $news->title }}</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li><a href="{{ route('college.news') }}">News</a></li>
            <li class="current">{{ Str::limit($news->title, 30) }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Blog Details Section -->
    <section id="blog-details" class="blog-details section">
      <div class="container" data-aos="fade-up">

        <article class="article">
          <div class="article-header">
            @if($news->category)
              <div class="meta-categories" data-aos="fade-up">
                <a href="{{ route('college.news') }}?category={{ urlencode($news->category) }}" class="category">{{ $news->category }}</a>
              </div>
            @endif

            <h1 class="title" data-aos="fade-up" data-aos-delay="100">{{ $news->title }}</h1>

            <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
              @if($news->author_name)
                <div class="author">
                  @if($news->author_image)
                    <img src="{{ asset(ltrim($news->author_image, '/')) }}" alt="{{ $news->author_name }}" class="author-img">
                  @else
                    <img src="/College/assets/img/person/person-m-6.webp" alt="Author" class="author-img">
                  @endif
                  <div class="author-info">
                    <h4>{{ $news->author_name }}</h4>
                  </div>
                </div>
              @endif
              <div class="post-info">
                @if($news->published_at)
                  <span><i class="bi bi-calendar4-week"></i> {{ $news->published_at->format('F d, Y') }}</span>
                @endif
              </div>
            </div>
          </div>

          @if($news->image)
            <div class="article-featured-image" data-aos="zoom-in">
              <img src="{{ asset(ltrim($news->image, '/')) }}" alt="{{ $news->title }}" class="img-fluid">
            </div>
          @endif

          <div class="article-wrapper">
            <div class="article-content">
              <div class="content-section" data-aos="fade-up">
                @if($news->excerpt)
                  <p class="lead">{{ $news->excerpt }}</p>
                @endif

                @if($news->content)
                  <div class="news-content">
                    {!! nl2br(e($news->content)) !!}
                  </div>
                @elseif($news->excerpt)
                  <p>{{ $news->excerpt }}</p>
                @endif
              </div>
            </div>
          </div>

          <div class="article-footer" data-aos="fade-up">
            <div class="share-article">
              <h4>Share this article</h4>
              <div class="share-buttons">
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" class="share-button twitter" target="_blank">
                  <i class="bi bi-twitter-x"></i>
                  <span>Share on X</span>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" class="share-button facebook" target="_blank">
                  <i class="bi bi-facebook"></i>
                  <span>Share on Facebook</span>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" class="share-button linkedin" target="_blank">
                  <i class="bi bi-linkedin"></i>
                  <span>Share on LinkedIn</span>
                </a>
              </div>
            </div>

            @if($news->category)
              <div class="article-tags">
                <h4>Related Topics</h4>
                <div class="tags">
                  <a href="{{ route('college.news') }}?category={{ urlencode($news->category) }}" class="tag">{{ $news->category }}</a>
                </div>
              </div>
            @endif
          </div>

        </article>

        @if($relatedNews->count() > 0)
          <div class="related-news mt-5" data-aos="fade-up">
            <h3 class="mb-4">Related News</h3>
            <div class="row g-4">
              @foreach($relatedNews as $item)
                <div class="col-md-4">
                  <article>
                    <div class="post-img">
                      @if($item->image)
                        <img src="{{ asset(ltrim($item->image, '/')) }}" alt="{{ $item->title }}" class="img-fluid">
                      @else
                        <img src="/College/assets/img/blog/blog-post-1.webp" alt="" class="img-fluid">
                      @endif
                    </div>
                    @if($item->category)
                      <p class="post-category">{{ $item->category }}</p>
                    @endif
                    <h2 class="title">
                      <a href="{{ route('college.news.show', $item) }}">{{ $item->title }}</a>
                    </h2>
                    @if($item->published_at)
                      <p class="post-date">
                        <time datetime="{{ $item->published_at->format('Y-m-d') }}">{{ $item->published_at->format('M d, Y') }}</time>
                      </p>
                    @endif
                  </article>
                </div>
              @endforeach
            </div>
          </div>
        @endif

      </div>
    </section><!-- /Blog Details Section -->

</main>
@endsection
