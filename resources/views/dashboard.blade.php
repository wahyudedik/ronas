<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            @can('manage landing')
                <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Landing Page Setup</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.heroes.index') }}">Hero</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.stats.index') }}">Statistics</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.programs.index') }}">Featured Programs</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.student-life.index') }}">Student Life</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.testimonials.index') }}">Testimonials</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.news.index') }}">News</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.events.index') }}">Events</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.landing.sections.index') }}">Section Titles</a>
                        </div>
                    </div>
                </div>
            @endcan

            @can('manage facilities')
                <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Campus Facilities Setup</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.categories.index') }}">Facility Categories</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.items.index') }}">Facility Items</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.virtual-tours.index') }}">Virtual Tour</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.virtual-tour-features.index') }}">Virtual Tour Features</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.highlights.index') }}">Highlights Carousel</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.map-settings.index') }}">Map Settings</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.map-categories.index') }}">Map Categories</a>
                            <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('admin.facilities.map-actions.index') }}">Map Actions</a>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">College Site</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.index') }}">Home</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.about') }}">About Us</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.admissions') }}">Admissions</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.academics') }}">Academics</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.faculty-staff') }}">Faculty &amp; Staff</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.campus-facilities') }}">Campus &amp; Facilities</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.students-life') }}">Students Life</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.news') }}">News</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.news-details') }}">News Details</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.events') }}">Events</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.event-details') }}">Event Details</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.alumni') }}">Alumni</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.contact') }}">Contact</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.privacy') }}">Privacy</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.terms-of-service') }}">Terms of Service</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.starter') }}">Starter Page</a>
                        <a class="text-blue-600 hover:underline dark:text-blue-400" href="{{ route('college.404') }}">Error 404</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
