<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('admin.contact.messages.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Messages</a>
                        
                        <form action="{{ route('admin.contact.messages.update', $message) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                <option value="unread" {{ $message->status == 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Replied</option>
                            </select>
                        </form>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">From</p>
                            <p class="font-semibold">{{ $message->name }} <span class="text-gray-400 font-normal">&lt;{{ $message->email }}&gt;</span></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p>{{ $message->created_at->format('F d, Y \a\t H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-500">Subject</p>
                        <h3 class="text-xl font-bold">{{ $message->subject }}</h3>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                        <p class="whitespace-pre-wrap">{{ $message->message }}</p>
                    </div>

                    <div class="mt-6 text-right">
                        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Reply via Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
