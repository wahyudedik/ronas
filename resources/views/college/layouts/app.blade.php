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
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('College/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('College/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('College/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('College/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('College/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('College/assets/css/main.css') }}" rel="stylesheet">

    <style>
        .brand-logo {
            height: 42px;
            width: 42px;
            object-fit: contain;
            background: #ffffff;
            border-radius: 8px;
            padding: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
    </style>

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
        $aboutActive = request()->routeIs(
            'college.about',
            'college.admissions',
            'college.academics',
            'college.faculty-staff',
            'college.campus-facilities',
        );
    @endphp

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-end">

            <a href="{{ route('college.index') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('logo.jpg') }}" alt="Logo" class="me-2 brand-logo">
                <h1 class="sitename mb-0">SMKS Roudlotun Nasyiin</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('college.index') }}"
                            class="{{ request()->routeIs('college.index') ? 'active' : '' }}">Home</a></li>
                    <li class="dropdown">
                        <a href="{{ route('college.about') }}"
                            class="{{ $aboutActive ? 'active' : '' }}"><span>About</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('college.about') }}"
                                    class="{{ request()->routeIs('college.about') ? 'active' : '' }}">About Us</a></li>
                            <li><a href="{{ route('college.about') }}#history">Sejarah</a></li>
                            <li><a href="{{ route('college.about') }}#mission-vision">Misi &amp; Visi</a></li>
                            <li><a href="{{ route('college.about') }}#core-values">Nilai Inti</a></li>
                            <li><a href="{{ route('college.about') }}#leadership">Leadership/Team</a></li>
                            <li><a href="{{ route('college.admissions') }}"
                                    class="{{ request()->routeIs('college.admissions') ? 'active' : '' }}">Admissions</a>
                            </li>
                            <li><a href="{{ route('college.admissions') }}#admissions-steps">Langkah Pendaftaran</a>
                            </li>
                            <li><a href="{{ route('college.admissions') }}#admissions-requirements">Syarat</a></li>
                            <li><a href="{{ route('college.admissions') }}#admissions-tuition">Biaya</a></li>
                            <li><a href="{{ route('college.admissions') }}#admissions-deadlines">Deadline</a></li>
                            <li><a href="{{ route('college.admissions') }}#admissions-request-info">Request Info</a>
                            </li>
                            <li><a href="{{ route('college.academics') }}"
                                    class="{{ request()->routeIs('college.academics') ? 'active' : '' }}">Academics</a>
                            </li>
                            <li><a href="{{ route('college.faculty-staff') }}"
                                    class="{{ request()->routeIs('college.faculty-staff') ? 'active' : '' }}">Faculty
                                    &amp; Staff</a></li>
                            <li><a href="{{ route('college.campus-facilities') }}"
                                    class="{{ request()->routeIs('college.campus-facilities') ? 'active' : '' }}">Campus
                                    &amp; Facilities</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('college.students-life') }}"
                            class="{{ request()->routeIs('college.students-life') ? 'active' : '' }}">Students Life</a>
                    </li>

                    <li class="dropdown">
                        <a href="{{ route('college.news') }}"
                            class="{{ request()->routeIs('college.news*') ? 'active' : '' }}"><span>News</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('college.news') }}">All News</a></li>
                            <li><a href="{{ route('college.news') }}">Categories</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="{{ route('college.events') }}"
                            class="{{ request()->routeIs('college.events*') ? 'active' : '' }}"><span>Events</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('college.events') }}">Upcoming Events</a></li>
                            <li><a href="{{ route('college.events', ['view' => 'past']) }}">Past Events</a></li>
                            <li><a href="{{ route('college.events') }}">Calendar</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('college.alumni.index') }}"
                            class="{{ request()->routeIs('college.alumni*') ? 'active' : '' }}">Alumni</a></li>
                    <li><a href="{{ route('college.contact') }}"
                            class="{{ request()->routeIs('college.contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    @yield('main')

    <footer id="footer" class="footer position-relative light-background">
        <div class="container footer-top">
            <div class="row gy-4 align-items-start">
                <div class="col-lg-6">
                    <h4 class="mb-2">SMKS Roudlotun Nasyiin</h4>
                    <p class="mb-1">Jl. Pendidikan No.05, Berat Besuk, Beratkulon,</p>
                    <p class="mb-3">Kec. Kemlagi, Kabupaten Mojokerto, Jawa Timur 61353</p>
                    <a href="https://maps.app.goo.gl/adSmVtuAMTMV5aqZ7" class="text-decoration-underline"
                        target="_blank" rel="noopener">
                        Lihat di Google Maps
                    </a>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a href="{{ route('college.index') }}" class="d-inline-flex align-items-center">
                        <img src="{{ asset('logo.jpg') }}" alt="Logo" class="me-2 brand-logo">
                        <span class="sitename">SMKS Roudlotun Nasyiin</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© {{ date('Y') }} <strong class="px-1 sitename">SMKS Roudlotun Nasyiin</strong> <span>All Rights
                    Reserved</span>
            </p>
            <div class="credits">
                Developed by <a href="https://noteds.com" target="_blank" rel="noopener">Noteds Technology</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
