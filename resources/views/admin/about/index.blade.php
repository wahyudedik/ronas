<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('About Page Setup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.about.histories.index') }}">History</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.about.milestones.index') }}">History Milestones</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.about.mission-visions.index') }}">Mission &amp; Vision</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.about.core-values.index') }}">Core Values</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.about.leadership-sections.index') }}">Leadership Section</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.about.leadership-highlights.index') }}">Leadership Highlights</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.about.leadership-members.index') }}">Leadership Team</a>
            </div>
        </div>
    </div>
</x-app-layout>
