@extends('college.layouts.app')

@section('title', 'Submit Your Story - Alumni')

@section('main')
<main class="main">

    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Submit Your Story</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li><a href="{{ route('college.alumni.index') }}">Alumni</a></li>
            <li class="current">Submit Story</li>
          </ol>
        </nav>
      </div>
    </div>

    <section class="section">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('college.alumni.submit-story') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title of Your Story</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="alumni_name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="alumni_name" name="alumni_name" value="{{ old('alumni_name', Auth::user()->name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="graduation_year" class="form-label">Graduation Year</label>
                                    <input type="number" class="form-control" id="graduation_year" name="graduation_year" min="1900" max="{{ date('Y') }}" value="{{ old('graduation_year') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="featured_image" class="form-label">Photo (Optional)</label>
                                <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Your Story</label>
                                <textarea class="form-control" id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
                                <div class="form-text">Share your journey, achievements, and memories.</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit Story for Approval</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

</main>
@endsection
