<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Events</h2>
            <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold">
                Add Event
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead>
                            <tr class="text-left">
                                <th class="py-2">Title</th>
                                <th class="py-2">Category</th>
                                <th class="py-2">Event Date</th>
                                <th class="py-2">Location</th>
                                <th class="py-2">Slug</th>
                                <th class="py-2">Active</th>
                                <th class="py-2 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($events as $event)
                                <tr>
                                    <td class="py-2">{{ $event->title }}</td>
                                    <td class="py-2">{{ $event->category ?? '-' }}</td>
                                    <td class="py-2">{{ optional($event->event_date)->format('Y-m-d') ?? '-' }}</td>
                                    <td class="py-2">{{ $event->location ?? '-' }}</td>
                                    <td class="py-2">
                                        <code class="text-xs">{{ $event->slug }}</code>
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded {{ $event->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $event->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="py-2 text-right">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Edit</a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-3 text-red-600 hover:underline dark:text-red-400" onclick="return confirm('Delete this event?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 text-center text-gray-500">No events yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
