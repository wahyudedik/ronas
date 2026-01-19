@extends('college.layouts.app')

@section('title', 'Admissions - College Bootstrap Template')
@section('body-class', 'admissions-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{ $pageSetting?->page_title ?? 'Admissions' }}</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">{{ $pageSetting?->breadcrumb_title ?? 'Admissions' }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Admissions Section -->
    <section id="admissions" class="admissions section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div id="admissions-steps" class="application-steps">
              <h3 class="section-subtitle">How to Apply</h3>
              <div class="steps-wrapper">
                @foreach($steps as $step)
                  <div class="step-item">
                    <div class="step-number">{{ $step->step_number ?? str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="step-content">
                      <h4>{{ $step->title }}</h4>
                      <p>{{ $step->description }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div id="admissions-requirements" class="requirements-card">
              <h3 class="section-subtitle">{{ $requirementSetting?->title ?? 'Admission Requirements' }}</h3>
              <ul class="requirements-list">
                @foreach($requirements as $requirement)
                  <li>
                    <i class="bi bi-check-circle"></i>
                    <span>{{ $requirement->text }}</span>
                  </li>
                @endforeach
              </ul>
              @if(!empty($requirementSetting?->note))
                <div class="special-note">
                  <i class="bi bi-info-circle"></i>
                  <p>{{ $requirementSetting->note }}</p>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="row mt-5 gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div id="admissions-tuition" class="tuition-card">
              <h3 class="section-subtitle">{{ $tuitionSetting?->title ?? 'Tuition & Fees' }}</h3>
              <div class="tuition-table">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Program</th>
                      <th>Tuition (per year)</th>
                      <th>Fees</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tuitions as $tuition)
                      <tr>
                        <td>{{ $tuition->program }}</td>
                        <td>{{ $tuition->tuition }}</td>
                        <td>{{ $tuition->fees }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="financial-aid">
                <h4>{{ $tuitionSetting?->aid_title ?? 'Financial Aid Available' }}</h4>
                <p>{{ $tuitionSetting?->aid_description ?? '' }}</p>
                @if(!empty($tuitionSetting?->aid_button_label))
                  <a href="{{ $tuitionSetting->aid_button_url ?? '#' }}" class="btn btn-aid">{{ $tuitionSetting->aid_button_label }}</a>
                @endif
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div id="admissions-request-info" class="contact-form-card">
              <h3 class="section-subtitle">{{ $requestInfoSetting?->title ?? 'Request Information' }}</h3>
              <form action="{{ $requestInfoSetting?->form_action ?? '/College/forms/contact.php' }}" class="php-email-form">
                <div class="row g-3">
                  <div class="col-12">
                    <input type="text" name="name" class="form-control" placeholder="Name*" required="">
                  </div>
                  <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email Address*" required="">
                  </div>
                  <div class="col-md-6">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                  </div>
                  <div class="col-12">
                    <select name="subject" class="form-select" required="">
                      <option selected="" disabled="">{{ $requestInfoSetting?->program_placeholder ?? 'Program of Interest*' }}</option>
                      @foreach($requestPrograms as $program)
                        <option>{{ $program->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-12">
                    <textarea name="message" class="form-control" rows="7" placeholder="Questions or Comments"></textarea>
                  </div>
                  <div class="col-12">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                    <button type="submit" class="btn btn-request">{{ $requestInfoSetting?->submit_label ?? 'Request Information' }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-12" data-aos="fade-up" data-aos-delay="100">
            <div id="admissions-deadlines" class="deadlines-card">
              <h3 class="section-subtitle">{{ $deadlineSetting?->title ?? 'Important Deadlines' }}</h3>
              <div class="deadlines-grid">
                @foreach($deadlines as $deadline)
                  <div class="deadline-item" data-aos="zoom-in" data-aos-delay="{{ 200 + ($loop->index * 100) }}">
                    <div class="deadline-date">{{ $deadline->date_text }}</div>
                    <h4>{{ $deadline->title }}</h4>
                    <p>{{ $deadline->description }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div id="admissions-campus-visit" class="row mt-5 campus-visit">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <div class="visit-image">
              <img src="{{ $campusVisitSetting?->image ? asset(ltrim($campusVisitSetting->image, '/')) : asset('College/assets/img/education/campus-5.webp') }}" class="img-fluid" alt="Campus Visit" loading="lazy">
              <div class="image-caption">{{ $campusVisitSetting?->image_caption ?? 'Experience our beautiful campus in person' }}</div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="visit-content">
              <h3>{{ $campusVisitSetting?->title ?? 'Schedule a Campus Visit' }}</h3>
              <p>{{ $campusVisitSetting?->description ?? '' }}</p>
              <ul class="visit-options">
                @foreach($campusVisitOptions as $option)
                  <li><i class="{{ $option->icon_class ?? 'bi bi-check-circle' }}"></i> {{ $option->text }}</li>
                @endforeach
              </ul>
              @if(!empty($campusVisitSetting?->button_label))
                <a href="{{ $campusVisitSetting->button_url ?? '#' }}" class="btn btn-schedule">{{ $campusVisitSetting->button_label }}</a>
              @endif
              <div class="virtual-option">
                <span>Can't visit in person?</span>
                @if(!empty($campusVisitSetting?->virtual_label))
                  <a href="{{ $campusVisitSetting->virtual_url ?? '#' }}" class="virtual-link">{{ $campusVisitSetting->virtual_label }} <i class="bi bi-arrow-right"></i></a>
                @endif
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Admissions Section -->

  </main>
@endsection
