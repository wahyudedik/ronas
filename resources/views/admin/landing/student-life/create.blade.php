<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add Student Life Item') }}
            </h2>
            <a href="{{ route('admin.landing.student-life.index') }}"
                class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.student-life.store') }}" class="space-y-4"
                        enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title')"
                                required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category" value="Category" />
                            <select id="category" name="category"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="">Select Category</option>
                                <option value="organizations"
                                    {{ old('category') == 'organizations' ? 'selected' : '' }}>Organizations</option>
                                <option value="athletics" {{ old('category') == 'athletics' ? 'selected' : '' }}>
                                    Athletics</option>
                                <option value="facilities" {{ old('category') == 'facilities' ? 'selected' : '' }}>
                                    Facilities</option>
                                <option value="support_services"
                                    {{ old('category') == 'support_services' ? 'selected' : '' }}>Support Services
                                </option>
                                <option value="gallery" {{ old('category') == 'gallery' ? 'selected' : '' }}>Gallery
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="badge_text" value="Badge Text (Optional)" />
                            <x-text-input id="badge_text" name="badge_text" class="mt-1 block w-full" :value="old('badge_text')"
                                placeholder="e.g., Winner" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Image" />
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="link_label" value="Link Label" />
                            <x-text-input id="link_label" name="link_label" class="mt-1 block w-full"
                                :value="old('link_label')" />
                        </div>

                        <div>
                            <x-input-label for="link_url" value="Link URL" />
                            <x-text-input id="link_url" name="link_url" class="mt-1 block w-full" :value="old('link_url')" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                :value="old('sort_order', 0)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                class="rounded border-gray-300" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active">Active</label>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>Save</x-primary-button>
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
