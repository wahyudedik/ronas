<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Event</h2>
            <a href="{{ route('admin.events.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Title *" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $event->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="slug" value="Slug" />
                            <x-text-input id="slug" name="slug" class="mt-1 block w-full" :value="old('slug', $event->slug)" />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category" value="Category" />
                            <x-text-input id="category" name="category" class="mt-1 block w-full" :value="old('category', $event->category)" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description', $event->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="event_date" value="Event Date" />
                                <x-text-input id="event_date" name="event_date" type="date" class="mt-1 block w-full" :value="old('event_date', optional($event->event_date)->format('Y-m-d'))" />
                            </div>

                            <div>
                                <x-input-label for="event_time" value="Event Time" />
                                <x-text-input id="event_time" name="event_time" class="mt-1 block w-full" :value="old('event_time', $event->event_time)" placeholder="e.g., 09:00 AM - 04:00 PM" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="location" value="Location" />
                            <x-text-input id="location" name="location" class="mt-1 block w-full" :value="old('location', $event->location)" />
                        </div>

                        <div>
                            <x-input-label for="participants" value="Participants" />
                            <x-text-input id="participants" name="participants" class="mt-1 block w-full" :value="old('participants', $event->participants)" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Featured Image" />
                            @if($event->image)
                                <div class="mb-2">
                                    <img src="{{ asset($event->image) }}" alt="Event" class="h-40 w-auto rounded">
                                </div>
                            @endif
                            <x-text-input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="registration_url" value="Registration URL" />
                            <x-text-input id="registration_url" name="registration_url" type="url" class="mt-1 block w-full" :value="old('registration_url', $event->registration_url)" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $event->sort_order)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                            <label for="is_active">Active</label>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
