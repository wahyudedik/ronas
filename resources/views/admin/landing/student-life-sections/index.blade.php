<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Student Life Section Settings
            </h2>
            <a href="{{ route('admin.landing.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @php
                $sectionList = [
                    'landing' => 'Landing Block',
                    'organizations' => 'Organisasi',
                    'athletics' => 'Atletik',
                    'facilities' => 'Fasilitas',
                    'support_services' => 'Layanan Pendukung',
                    'gallery' => 'Galeri',
                ];
            @endphp

            @foreach($sectionList as $key => $label)
                @php
                    $section = $sections[$key] ?? null;
                @endphp
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-sm font-semibold mb-4">{{ $label }}</h3>
                        <form method="POST" action="{{ route('admin.landing.student-life-sections.update', $key) }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <x-input-label for="title-{{ $key }}" value="Title" />
                                <x-text-input id="title-{{ $key }}" name="title" class="mt-1 block w-full" :value="old('title', $section->title ?? $label)" />
                            </div>
                            <div>
                                <x-input-label for="subtitle-{{ $key }}" value="Subtitle" />
                                <x-text-input id="subtitle-{{ $key }}" name="subtitle" class="mt-1 block w-full" :value="old('subtitle', $section->subtitle ?? '')" />
                            </div>
                            <div class="flex items-center gap-2 mt-6">
                                <input type="checkbox" id="is_active-{{ $key }}" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}>
                                <label for="is_active-{{ $key }}">Active</label>
                            </div>
                            <div class="md:col-span-3 flex justify-end">
                                <x-primary-button>Save</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
