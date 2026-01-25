<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Event</h2>
            <a href="{{ route('admin.events.index') }}"
                class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-4"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Title *" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $event->title)"
                                required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="slug" value="Slug" />
                            <x-text-input id="slug" name="slug" class="mt-1 block w-full" :value="old('slug', $event->slug)" />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Category" />
                            <select id="category_id" name="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="upcoming"
                                    {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming
                                </option>
                                <option value="ongoing"
                                    {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="past" {{ old('status', $event->status) == 'past' ? 'selected' : '' }}>
                                    Past</option>
                                <option value="cancelled"
                                    {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description', $event->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_date" value="Start Date *" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                                    :value="old('start_date', optional($event->start_date)->format('Y-m-d'))" required />
                            </div>
                            <div>
                                <x-input-label for="end_date" value="End Date" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                                    :value="old('end_date', optional($event->end_date)->format('Y-m-d'))" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_time" value="Start Time" />
                                <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full"
                                    :value="old(
                                        'start_time',
                                        $event->start_time
                                            ? \Carbon\Carbon::parse($event->start_time)->format('H:i')
                                            : '',
                                    )" />
                            </div>
                            <div>
                                <x-input-label for="end_time" value="End Time" />
                                <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full"
                                    :value="old(
                                        'end_time',
                                        $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('H:i') : '',
                                    )" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="venue" value="Venue" />
                            <x-text-input id="venue" name="venue" class="mt-1 block w-full" :value="old('venue', $event->venue)" />
                        </div>

                        <div>
                            <x-input-label for="address" value="Address" />
                            <textarea id="address" name="address" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('address', $event->address) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="capacity" value="Capacity" />
                                <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full"
                                    :value="old('capacity', $event->capacity)" />
                            </div>
                            <div>
                                <x-input-label for="registration_deadline" value="Registration Deadline" />
                                <x-text-input id="registration_deadline" name="registration_deadline"
                                    type="datetime-local" class="mt-1 block w-full" :value="old(
                                        'registration_deadline',
                                        $event->registration_deadline
                                            ? \Carbon\Carbon::parse($event->registration_deadline)->format('Y-m-d\TH:i')
                                            : '',
                                    )" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="image" value="Featured Image" />
                            @if ($event->image)
                                <div class="mb-2">
                                    <img src="{{ asset($event->image) }}" alt="Event"
                                        class="h-40 w-auto rounded">
                                </div>
                            @endif
                            <x-text-input id="image" name="image" type="file" accept="image/*"
                                class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="registration_url" value="External Registration URL (Optional)" />
                            <x-text-input id="registration_url" name="registration_url" type="url"
                                class="mt-1 block w-full" :value="old('registration_url', $event->registration_url)" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                :value="old('sort_order', $event->sort_order)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                class="rounded border-gray-300"
                                {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
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

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'), {
                    ckfinder: {
                        uploadUrl: '{{ route('admin.upload', ['_token' => csrf_token()]) }}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>
