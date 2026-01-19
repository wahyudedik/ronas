<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'College')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('favicon.jpg') }}" rel="icon">
  <link href="{{ asset('logo.jpg') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('College/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('College/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('College/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('College/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('College/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('College/assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: College
  * Template URL: https://bootstrapmade.com/college-bootstrap-education-template/
  * Updated: Jun 19 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="@yield('body-class')">

  @php
    $aboutActive = request()->routeIs('college.about', 'college.admissions', 'college.academics', 'college.faculty-staff', 'college.campus-facilities');
    $morePagesActive = request()->routeIs('college.news-details', 'college.event-details', 'college.privacy', 'college.terms-of-service', 'college.404', 'college.starter');
  @endphp

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-end">

      <a href="{{ route('college.index') }}" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('logo.jpg') }}" alt="Logo" class="me-2" style="height: 40px;">
        <h1 class="sitename">College</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('college.index') }}" class="{{ request()->routeIs('college.index') ? 'active' : '' }}">Home</a></li>
          <li class="dropdown">
            <a href="{{ route('college.about') }}" class="{{ $aboutActive ? 'active' : '' }}"><span>About</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('college.about') }}" class="{{ request()->routeIs('college.about') ? 'active' : '' }}">About Us</a></li>
              <li><a href="{{ route('college.admissions') }}" class="{{ request()->routeIs('college.admissions') ? 'active' : '' }}">Admissions</a></li>
              <li><a href="{{ route('college.academics') }}" class="{{ request()->routeIs('college.academics') ? 'active' : '' }}">Academics</a></li>
              <li><a href="{{ route('college.faculty-staff') }}" class="{{ request()->routeIs('college.faculty-staff') ? 'active' : '' }}">Faculty &amp; Staff</a></li>
              <li><a href="{{ route('college.campus-facilities') }}" class="{{ request()->routeIs('college.campus-facilities') ? 'active' : '' }}">Campus &amp; Facilities</a></li>
            </ul>
          </li>

          <li><a href="{{ route('college.students-life') }}" class="{{ request()->routeIs('college.students-life') ? 'active' : '' }}">Students Life</a></li>
          <li><a href="{{ route('college.news') }}" class="{{ request()->routeIs('college.news') ? 'active' : '' }}">News</a></li>
          <li><a href="{{ route('college.events') }}" class="{{ request()->routeIs('college.events') ? 'active' : '' }}">Events</a></li>
          <li><a href="{{ route('college.alumni') }}" class="{{ request()->routeIs('college.alumni') ? 'active' : '' }}">Alumni</a></li>
          <li class="dropdown">
            <a href="#" class="{{ $morePagesActive ? 'active' : '' }}"><span>More Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('college.news-details') }}" class="{{ request()->routeIs('college.news-details') ? 'active' : '' }}">News Details</a></li>
              <li><a href="{{ route('college.event-details') }}" class="{{ request()->routeIs('college.event-details') ? 'active' : '' }}">Event Details</a></li>
              <li><a href="{{ route('college.privacy') }}" class="{{ request()->routeIs('college.privacy') ? 'active' : '' }}">Privacy</a></li>
              <li><a href="{{ route('college.terms-of-service') }}" class="{{ request()->routeIs('college.terms-of-service') ? 'active' : '' }}">Terms of Service</a></li>
              <li><a href="{{ route('college.404') }}" class="{{ request()->routeIs('college.404') ? 'active' : '' }}">Error 404</a></li>
              <li><a href="{{ route('college.starter') }}" class="{{ request()->routeIs('college.starter') ? 'active' : '' }}">Starter Page</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="{{ route('college.contact') }}" class="{{ request()->routeIs('college.contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  @yield('main')

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ route('college.index') }}" class="logo d-flex align-items-center">
            <span class="sitename">College</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li><a href="{{ route('college.about') }}">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="{{ route('college.terms-of-service') }}">Terms of service</a></li>
            <li><a href="{{ route('college.privacy') }}">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">MyWebsite</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('College/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('College/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('College/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('College/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('College/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('College/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('College/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('College/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('College/assets/js/main.js') }}"></script>

</body>

</html>
