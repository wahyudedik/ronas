<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Landing Page Setup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.landing.hero') }}">Hero</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.landing.stats.index') }}">Statistics</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.landing.programs.index') }}">Featured Programs</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.landing.student-life.index') }}">Student Life</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.landing.testimonials.index') }}">Testimonials</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.landing.news.index') }}">News</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.landing.events.index') }}">Events</a>
            </div>
        </div>
    </div>
</x-app-layout>
