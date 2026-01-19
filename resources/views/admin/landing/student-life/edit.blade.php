<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Student Life Item</h2>
            <a href="{{ route('admin.landing.student-life.index') }}" class="text-sm text-indigo-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.student-life.update', $item) }}" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.landing.student-life.partials.form', ['item' => $item])
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
                {{ __('Edit Student Life Item') }}
            </h2>
            <a href="{{ route('admin.landing.student-life.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.student-life.update', $item) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $item->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description', $item->description) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="image_path" value="Image Path" />
                            <x-text-input id="image_path" name="image_path" class="mt-1 block w-full" :value="old('image_path', $item->image_path)" />
                        </div>

                        <div>
                            <x-input-label for="cta_text" value="CTA Text" />
                            <x-text-input id="cta_text" name="cta_text" class="mt-1 block w-full" :value="old('cta_text', $item->cta_text)" />
                        </div>

                        <div>
                            <x-input-label for="cta_url" value="CTA URL" />
                            <x-text-input id="cta_url" name="cta_url" class="mt-1 block w-full" :value="old('cta_url', $item->cta_url)" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $item->sort_order)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
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
