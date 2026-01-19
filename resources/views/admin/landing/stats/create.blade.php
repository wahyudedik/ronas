<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add Stat</h2>
            <a href="{{ route('admin.landing.stats.index') }}" class="text-sm text-indigo-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.stats.store') }}" class="space-y-4">
                        @csrf
                        @include('admin.landing.stats.partials.form', ['stat' => null])
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
                {{ __('Add Stat') }}
            </h2>
            <a href="{{ route('admin.landing.stats.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.landing.stats.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="label" value="Label" />
                            <x-text-input id="label" name="label" class="mt-1 block w-full" :value="old('label')" required />
                            <x-input-error :messages="$errors->get('label')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="value" value="Value" />
                            <x-text-input id="value" name="value" class="mt-1 block w-full" :value="old('value')" required />
                            <x-input-error :messages="$errors->get('value')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="suffix" value="Suffix (optional)" />
                            <x-text-input id="suffix" name="suffix" class="mt-1 block w-full" :value="old('suffix')" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="Sort Order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', 0)" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', true) ? 'checked' : '' }}>
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
