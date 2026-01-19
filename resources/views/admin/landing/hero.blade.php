<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Hero Section') }}
            </h2>
            <a href="{{ route('admin.landing.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.hero.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $hero->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="subtitle" value="Subtitle" />
                            <x-text-input id="subtitle" name="subtitle" class="mt-1 block w-full" :value="old('subtitle', $hero->subtitle)" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description', $hero->description) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="badge_text" value="Badge Text" />
                            <x-text-input id="badge_text" name="badge_text" class="mt-1 block w-full" :value="old('badge_text', $hero->badge_text)" />
                        </div>

                        <div>
                            <x-input-label for="badge_icon" value="Badge Icon Class (optional)" />
                            <x-text-input id="badge_icon" name="badge_icon" class="mt-1 block w-full" :value="old('badge_icon', $hero->badge_icon)" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="primary_cta_text" value="Primary CTA Text" />
                                <x-text-input id="primary_cta_text" name="primary_cta_text" class="mt-1 block w-full" :value="old('primary_cta_text', $hero->primary_cta_text)" />
                            </div>
                            <div>
                                <x-input-label for="primary_cta_url" value="Primary CTA URL" />
                                <x-text-input id="primary_cta_url" name="primary_cta_url" class="mt-1 block w-full" :value="old('primary_cta_url', $hero->primary_cta_url)" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="secondary_cta_text" value="Secondary CTA Text" />
                                <x-text-input id="secondary_cta_text" name="secondary_cta_text" class="mt-1 block w-full" :value="old('secondary_cta_text', $hero->secondary_cta_text)" />
                            </div>
                            <div>
                                <x-input-label for="secondary_cta_url" value="Secondary CTA URL" />
                                <x-text-input id="secondary_cta_url" name="secondary_cta_url" class="mt-1 block w-full" :value="old('secondary_cta_url', $hero->secondary_cta_url)" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="image_path" value="Image Path (e.g. /College/assets/img/...)"/>
                            <x-text-input id="image_path" name="image_path" class="mt-1 block w-full" :value="old('image_path', $hero->image_path)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $hero->is_active) ? 'checked' : '' }}>
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
</x-app-layout>
