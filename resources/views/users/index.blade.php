<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-semibold text-white hover:bg-indigo-500">
                Add User
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                                    <th class="py-2">Name</th>
                                    <th class="py-2">Email</th>
                                    <th class="py-2">Created</th>
                                    <th class="py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="py-2">{{ $user->name }}</td>
                                        <td class="py-2">{{ $user->email }}</td>
                                        <td class="py-2">{{ $user->created_at?->format('Y-m-d') }}</td>
                                        <td class="py-2 text-right">
                                            <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Edit</a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-3 text-red-600 hover:underline dark:text-red-400" onclick="return confirm('Delete this user?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 text-center text-gray-500">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
