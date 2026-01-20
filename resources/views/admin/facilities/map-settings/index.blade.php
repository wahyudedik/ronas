<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Map Settings
            </h2>
            <a href="{{ route('admin.facilities.map-settings.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold">
                Add Setting
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
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead>
                                <tr class="text-left">
                                    <th class="py-2">Title</th>
                                    <th class="py-2">Embed URL</th>
                                    <th class="py-2">Active</th>
                                    <th class="py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($settings as $setting)
                                    <tr>
                                        <td class="py-2">{{ $setting->title }}</td>
                                        <td class="py-2">{{ $setting->embed_url }}</td>
                                        <td class="py-2">
                                            <form action="{{ route('admin.facilities.map-settings.toggle', $setting) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <label class="inline-flex items-center gap-2">
                                                    <input type="checkbox" class="js-toggle rounded border-gray-300" {{ $setting->is_active ? 'checked' : '' }}>
                                                    <span class="text-sm">{{ $setting->is_active ? 'Active' : 'Inactive' }}</span>
                                                </label>
                                            </form>
                                        </td>
                                        <td class="py-2 text-right">
                                            <a href="{{ route('admin.facilities.map-settings.edit', $setting) }}" class="text-indigo-600 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $settings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!token) return;

            document.querySelectorAll('.js-toggle').forEach((checkbox) => {
                checkbox.addEventListener('change', async () => {
                    if (!checkbox.checked && !confirm('Disable this item?')) {
                        checkbox.checked = true;
                        return;
                    }
                    const form = checkbox.closest('form');
                    const label = checkbox.closest('label')?.querySelector('span');
                    const formData = new FormData(form);
                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });
                        if (!response.ok) throw new Error('Request failed');
                        if (label) {
                            label.textContent = checkbox.checked ? 'Active' : 'Inactive';
                        }
                        showToast('Status updated.', 'success', { duration: 2000 });
                    } catch (error) {
                        checkbox.checked = !checkbox.checked;
                        showToast('Failed to update status.', 'error');
                    }
                });
            });
        })();
    </script>
</x-app-layout>
