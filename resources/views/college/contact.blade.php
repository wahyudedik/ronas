@extends('college.layouts.app')

@section('title', 'Contact - SMKS Roudlotun Nasyiin')
@section('body-class', 'contact-page')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Contact</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="contact-main-wrapper">
          <div class="map-wrapper">
            @if($contact->latitude && $contact->longitude)
                <iframe src="https://maps.google.com/maps?q={{ $contact->latitude }},{{ $contact->longitude }}&hl=es;z=14&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @else
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @endif
          </div>

          <div class="contact-content">
            <div class="contact-cards-container" data-aos="fade-up" data-aos-delay="300">
              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="contact-text">
                  <h4>Location</h4>
                  <p>{{ $contact->address ?? 'Address not available' }}</p>
                </div>
              </div>

              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="contact-text">
                  <h4>Email</h4>
                  <p><a href="mailto:{{ $contact->email ?? '#' }}">{{ $contact->email ?? 'Email not available' }}</a></p>
                </div>
              </div>

              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-telephone"></i>
                </div>
                <div class="contact-text">
                  <h4>Call</h4>
                  <p>{{ $contact->phone ?? 'Phone not available' }}</p>
                </div>
              </div>

              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-clock"></i>
                </div>
                <div class="contact-text">
                  <h4>Open Hours</h4>
                  @if($contact->operating_hours)
                      @foreach($contact->operating_hours as $day => $hours)
                        <p>{{ $day }}: {{ $hours }}</p>
                      @endforeach
                  @else
                    <p>Hours not available</p>
                  @endif
                </div>
              </div>
            </div>

            <div class="contact-form-container" data-aos="fade-up" data-aos-delay="400">
              <h3>Get in Touch</h3>
              <p>We'd love to hear from you. Please fill out the form below.</p>

              @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif

              <form action="{{ route('college.contact.store') }}" method="post" class="php-email-form">
                @csrf
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
                  @error('subject') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required=""></textarea>
                  @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="my-3">
                  <!-- Custom Loading/Error/Success handling can be done via JS if needed, but standard session flash is used here -->
                </div>

                <div class="form-submit">
                  <button type="submit">Send Message</button>
                  @if($contact?->social_media_links)
                  <div class="social-links">
                    @if(isset($contact->social_media_links['twitter']))
                        <a href="{{ $contact->social_media_links['twitter'] }}" target="_blank"><i class="bi bi-twitter"></i></a>
                    @endif
                    @if(isset($contact->social_media_links['facebook']))
                        <a href="{{ $contact->social_media_links['facebook'] }}" target="_blank"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if(isset($contact->social_media_links['instagram']))
                        <a href="{{ $contact->social_media_links['instagram'] }}" target="_blank"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if(isset($contact->social_media_links['linkedin']))
                        <a href="{{ $contact->social_media_links['linkedin'] }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                    @endif
                  </div>
                  @endif
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Contact Section -->

</main>
@endsection
