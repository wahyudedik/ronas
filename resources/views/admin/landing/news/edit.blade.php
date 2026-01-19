<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit News</h2>
            <a href="{{ route('admin.landing.news.index') }}" class="text-sm text-indigo-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.news.update', $newsItem) }}" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.landing.news.partials.form', ['newsItem' => $newsItem])
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
                {{ __('Edit News Item') }}
            </h2>
            <a href="{{ route('admin.landing.news.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.news.update', $newsItem) }}" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="category" value="Category" />
                            <x-text-input id="category" name="category" class="mt-1 block w-full" :value="old('category', $newsItem->category)" />
                        </div>

                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $newsItem->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="excerpt" value="Excerpt" />
                            <textarea id="excerpt" name="excerpt" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('excerpt', $newsItem->excerpt) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="author_name" value="Author Name" />
                            <x-text-input id="author_name" name="author_name" class="mt-1 block w-full" :value="old('author_name', $newsItem->author_name)" />
                        </div>

                        <div>
                            <x-input-label for="author_image" value="Author Image" />
                            <x-text-input id="author_image" name="author_image" type="file" class="mt-1 block w-full" />
                            @if(!empty($newsItem->author_image))
                                <img src="{{ asset(ltrim($newsItem->author_image, '/')) }}" alt="Author image" class="mt-2 h-20 rounded object-cover">
                            @endif
                        </div>

                        <div>
                            <x-input-label for="published_at" value="Published Date" />
                            <x-text-input id="published_at" name="published_at" type="date" class="mt-1 block w-full" :value="old('published_at', optional($newsItem->published_at)->format('Y-m-d'))" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Image" />
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
                            @if(!empty($newsItem->image))
                                <img src="{{ asset(ltrim($newsItem->image, '/')) }}" alt="News image" class="mt-2 h-20 rounded object-cover">
                            @endif
                        </div>

                        <div>
                            <x-input-label for="link_url" value="Link URL" />
                            <x-text-input id="link_url" name="link_url" class="mt-1 block w-full" :value="old('link_url', $newsItem->link_url)" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $newsItem->sort_order)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $newsItem->is_active) ? 'checked' : '' }}>
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
