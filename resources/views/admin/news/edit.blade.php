<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit News</h2>
            <a href="{{ route('admin.news.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.news.update', $news) }}" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Title *" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $news->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="slug" value="Slug" />
                            <x-text-input id="slug" name="slug" class="mt-1 block w-full" :value="old('slug', $news->slug)" />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category" value="Category" />
                            <x-text-input id="category" name="category" class="mt-1 block w-full" :value="old('category', $news->category)" />
                        </div>

                        <div>
                            <x-input-label for="excerpt" value="Excerpt" />
                            <textarea id="excerpt" name="excerpt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('excerpt', $news->excerpt) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="content" value="Content" />
                            <textarea id="content" name="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('content', $news->content) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="author_name" value="Author Name" />
                            <x-text-input id="author_name" name="author_name" class="mt-1 block w-full" :value="old('author_name', $news->author_name)" />
                        </div>

                        <div>
                            <x-input-label for="author_image" value="Author Image" />
                            @if($news->author_image)
                                <div class="mb-2">
                                    <img src="{{ asset($news->author_image) }}" alt="Author" class="h-20 w-20 rounded">
                                </div>
                            @endif
                            <x-text-input id="author_image" name="author_image" type="file" accept="image/*" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="published_at" value="Published Date" />
                            <x-text-input id="published_at" name="published_at" type="date" class="mt-1 block w-full" :value="old('published_at', optional($news->published_at)->format('Y-m-d'))" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Featured Image" />
                            @if($news->image)
                                <div class="mb-2">
                                    <img src="{{ asset($news->image) }}" alt="News" class="h-40 w-auto rounded">
                                </div>
                            @endif
                            <x-text-input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $news->sort_order)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $news->is_active) ? 'checked' : '' }}>
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
