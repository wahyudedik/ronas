<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('admin.contact.nav')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.contact.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            @foreach ($settings as $setting)
                                <div>
                                    <label for="{{ $setting->key }}"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                    </label>
                                    @if ($setting->description)
                                        <p class="text-xs text-gray-500 mb-1">{{ $setting->description }}</p>
                                    @endif

                                    @if (strlen($setting->value) > 100)
                                        <textarea name="settings[{{ $setting->key }}]" id="{{ $setting->key }}" rows="3"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                                    @else
                                        <input type="text" name="settings[{{ $setting->key }}]"
                                            id="{{ $setting->key }}"
                                            value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save
                                Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
