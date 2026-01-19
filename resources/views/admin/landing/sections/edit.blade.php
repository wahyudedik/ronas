<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Section</h2>
            <a href="{{ route('admin.landing.sections.index') }}" class="text-sm text-indigo-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.sections.update', $section) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium">Key</label>
                            <input name="key" class="mt-1 w-full rounded border-gray-300" value="{{ old('key', $section->key) }}" required>
                            <x-input-error :messages="$errors->get('key')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Title</label>
                            <input name="title" class="mt-1 w-full rounded border-gray-300" value="{{ old('title', $section->title) }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Subtitle</label>
                            <input name="subtitle" class="mt-1 w-full rounded border-gray-300" value="{{ old('subtitle', $section->subtitle) }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Description</label>
                            <textarea name="description" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('description', $section->description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Sort Order</label>
                            <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $section->sort_order) }}">
                        </div>
                        <div class="flex items-center gap-2">
                            <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="text-sm">Active</label>
                        </div>
                        <div class="flex justify-end">
                            <button class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
