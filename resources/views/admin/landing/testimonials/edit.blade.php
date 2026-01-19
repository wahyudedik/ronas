<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Testimonial</h2>
            <a href="{{ route('admin.landing.testimonials.index') }}" class="text-sm text-indigo-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.testimonials.update', $testimonial) }}" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.landing.testimonials.partials.form', ['testimonial' => $testimonial])
                        <div class="flex justify-end">
                            <button class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Testimonial') }}
            </h2>
            <a href="{{ route('admin.landing.testimonials.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.testimonials.update', $testimonial) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name', $testimonial->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="role" value="Role" />
                            <x-text-input id="role" name="role" class="mt-1 block w-full" :value="old('role', $testimonial->role)" />
                        </div>

                        <div>
                            <x-input-label for="quote" value="Quote" />
                            <textarea id="quote" name="quote" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('quote', $testimonial->quote) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="image_path" value="Image Path" />
                            <x-text-input id="image_path" name="image_path" class="mt-1 block w-full" :value="old('image_path', $testimonial->image_path)" />
                        </div>

                        <div>
                            <x-input-label for="rating" value="Rating (1-5)" />
                            <x-text-input id="rating" name="rating" type="number" min="1" max="5" class="mt-1 block w-full" :value="old('rating', $testimonial->rating)" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $testimonial->sort_order)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
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
