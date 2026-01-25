<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Information') }}
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

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Current Details</h3>
                        <a href="{{ route('admin.contact.info.edit', $contact) }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit Information</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-bold mb-2">General Info</h4>
                            <p><strong>Company Name:</strong> {{ $contact->company_name }}</p>
                            <p><strong>Address:</strong> {{ $contact->address }}</p>
                            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold mb-2">Location</h4>
                            <p><strong>Latitude:</strong> {{ $contact->latitude }}</p>
                            <p><strong>Longitude:</strong> {{ $contact->longitude }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold mb-2">Operating Hours</h4>
                            @if ($contact->operating_hours)
                                <ul class="list-disc pl-5">
                                    @foreach ($contact->operating_hours as $day => $hours)
                                        <li>{{ $day }}: {{ $hours }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Not set</p>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold mb-2">Social Media</h4>
                            @if ($contact->social_media_links)
                                <ul class="list-disc pl-5">
                                    @foreach ($contact->social_media_links as $platform => $link)
                                        <li>{{ ucfirst($platform) }}: <a href="{{ $link }}" target="_blank"
                                                class="text-blue-600 hover:underline">{{ $link }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Not set</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
