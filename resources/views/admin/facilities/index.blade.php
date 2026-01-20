<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Campus Facilities Setup
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.categories.index') }}">Facility Categories</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.items.index') }}">Facility Items</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.virtual-tours.index') }}">Virtual Tour</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.virtual-tour-features.index') }}">Virtual Tour Features</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.highlights.index') }}">Highlights Carousel</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.map-settings.index') }}">Campus Map Settings</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.map-categories.index') }}">Map Categories</a>
                <a class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow" href="{{ route('admin.facilities.map-actions.index') }}">Map Actions</a>
            </div>
        </div>
    </div>
</x-app-layout>
