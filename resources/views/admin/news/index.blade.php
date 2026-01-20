<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">News</h2>
            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold">
                Add News
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
                                <th class="py-2">Published Date</th>
                                <th class="py-2">Slug</th>
                                <th class="py-2">Active</th>
                                <th class="py-2 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($news as $item)
                                <tr>
                                    <td class="py-2">{{ $item->title }}</td>
                                    <td class="py-2">{{ $item->category ?? '-' }}</td>
                                    <td class="py-2">{{ optional($item->published_at)->format('Y-m-d') ?? '-' }}</td>
                                    <td class="py-2">
                                        <code class="text-xs">{{ $item->slug }}</code>
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="py-2 text-right">
                                        <a href="{{ route('admin.news.edit', $item) }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Edit</a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-3 text-red-600 hover:underline dark:text-red-400" onclick="return confirm('Delete this news?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500">No news yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
