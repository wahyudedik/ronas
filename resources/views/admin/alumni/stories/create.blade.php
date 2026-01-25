<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($story) ? __('Edit Story') : __('Create Story') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form
                        action="{{ isset($story) ? route('admin.alumni.stories.update', $story) : route('admin.alumni.stories.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($story))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="title"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $story->title ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300"
                                    required>
                                @error('title')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="alumni_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alumni
                                    Name</label>
                                <input type="text" name="alumni_name" id="alumni_name"
                                    value="{{ old('alumni_name', $story->alumni_name ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300"
                                    required>
                                @error('alumni_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="graduation_year"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Graduation
                                    Year</label>
                                <input type="number" name="graduation_year" id="graduation_year"
                                    value="{{ old('graduation_year', $story->graduation_year ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300"
                                    required>
                                @error('graduation_year')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                    <option value="pending"
                                        {{ old('status', $story->status ?? '') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="approved"
                                        {{ old('status', $story->status ?? '') == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected"
                                        {{ old('status', $story->status ?? '') == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                </select>
                                @error('status')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="content"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                            <textarea name="content" id="content" rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">{{ old('content', $story->content ?? '') }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="featured_image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured
                                Image</label>
                            @if (isset($story) && $story->featured_image)
                                <div class="mb-2">
                                    <img src="{{ asset($story->featured_image) }}" alt="Current Image"
                                        class="h-20 w-auto rounded">
                                </div>
                            @endif
                            <input type="file" name="featured_image" id="featured_image"
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100">
                            @error('featured_image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('admin.alumni.stories.index') }}"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mr-2 hover:bg-gray-400">Cancel</a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                {{ isset($story) ? 'Update Story' : 'Create Story' }}
                            </button>
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
                .create(document.querySelector('#content'), {
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
