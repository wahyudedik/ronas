<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Programs</h2>
            <a href="{{ route('admin.landing.programs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold">
                Add Program
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
                                <th class="py-2 w-8"></th>
                                <th class="py-2">Title</th>
                                <th class="py-2">Featured</th>
                                <th class="py-2">Order</th>
                                <th class="py-2">Active</th>
                                <th class="py-2 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="programs-sortable" class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($programs as $program)
                                <tr data-id="{{ $program->id }}">
                                    <td class="py-2">
                                        @include('admin.landing.partials.drag-handle')
                                    </td>
                                    <td class="py-2">{{ $program->title }}</td>
                                    <td class="py-2">{{ $program->is_featured ? 'Yes' : 'No' }}</td>
                                    <td class="py-2">{{ $program->sort_order }}</td>
                                    <td class="py-2">
                                        <form action="{{ route('admin.landing.programs.toggle', $program) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <label class="inline-flex items-center gap-2">
                                                <input type="checkbox" class="js-toggle rounded border-gray-300" {{ $program->is_active ? 'checked' : '' }}>
                                                <span class="text-sm">{{ $program->is_active ? 'Active' : 'Inactive' }}</span>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="py-2 text-right">
                                        <a href="{{ route('admin.landing.programs.edit', $program) }}" class="text-indigo-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.landing.programs.destroy', $program) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-3 text-red-600 hover:underline" onclick="return confirm('Delete this program?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $programs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<form id="programs-order-form" method="POST" action="{{ route('admin.landing.programs.reorder') }}">
    @csrf
    <input type="hidden" name="order" id="programs-order-input">
</form>

<div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <button id="programs-undo-btn" type="button" class="hidden rounded-md border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
        Undo last reorder
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    (function () {
        const tbody = document.getElementById('programs-sortable');
        const input = document.getElementById('programs-order-input');
        const form = document.getElementById('programs-order-form');

        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!tbody || !input || !form || !token) return;

        const getIds = () => Array.from(tbody.querySelectorAll('tr')).map(row => row.dataset.id);
        const applyOrder = (ids) => {
            const map = new Map(getIds().map(id => [id, tbody.querySelector(`tr[data-id="${id}"]`)]));
            ids.forEach((id) => {
                const row = map.get(id);
                if (row) tbody.appendChild(row);
            });
        };
        const sendOrder = (ids) => {
            input.value = ids.join(',');
            return fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({ order: input.value })
            });
        };

        const history = [];
        const undoBtn = document.getElementById('programs-undo-btn');
        let previousOrder = getIds();
        new Sortable(tbody, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'sortable-ghost',
            onStart: () => { previousOrder = getIds(); },
            onEnd: async () => {
                const newOrder = getIds();
                if (previousOrder.join(',') === newOrder.join(',')) return;
                try {
                    const response = await sendOrder(newOrder);
                    if (!response.ok) throw new Error('Request failed');
                    history.push(previousOrder);
                    if (undoBtn) undoBtn.classList.remove('hidden');
                    showToast('Order updated.', 'success', {
                        actionText: 'Undo',
                        onAction: async () => {
                            const last = history.pop();
                            if (!last) return;
                            applyOrder(last);
                            await sendOrder(last);
                            if (history.length === 0 && undoBtn) undoBtn.classList.add('hidden');
                            showToast('Order restored.', 'success', { duration: 2000 });
                        }
                    });
                } catch (error) {
                    applyOrder(previousOrder);
                    showToast('Failed to update order.', 'error');
                }
            }
        });

        if (undoBtn) {
            undoBtn.addEventListener('click', async () => {
                const last = history.pop();
                if (!last) return;
                applyOrder(last);
                await sendOrder(last);
                if (history.length === 0) undoBtn.classList.add('hidden');
                showToast('Order restored.', 'success', { duration: 2000 });
            });
        }

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
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Featured Programs') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.landing.index') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Back</a>
                <a href="{{ route('admin.landing.programs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Add Program</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-sm font-semibold mb-4">Section Settings</h3>
                    <form method="POST" action="{{ route('admin.landing.section.update', 'programs') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $setting->title)" />
                        </div>
                        <div>
                            <x-input-label for="subtitle" value="Subtitle" />
                            <x-text-input id="subtitle" name="subtitle" class="mt-1 block w-full" :value="old('subtitle', $setting->subtitle)" />
                        </div>
                        <div>
                            <x-input-label for="description" value="Description" />
                            <x-text-input id="description" name="description" class="mt-1 block w-full" :value="old('description', $setting->description)" />
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $setting->is_active) ? 'checked' : '' }}>
                            <label for="is_active">Active</label>
                        </div>
                        <div class="md:col-span-3 flex justify-end">
                            <x-primary-button>Save Section</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead>
                                <tr class="text-left text-gray-600 dark:text-gray-300">
                                    <th class="py-2">Title</th>
                                    <th class="py-2">Degree</th>
                                    <th class="py-2">Duration</th>
                                    <th class="py-2">Order</th>
                                    <th class="py-2">Active</th>
                                    <th class="py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($programs as $program)
                                    <tr>
                                        <td class="py-2">{{ $program->title }}</td>
                                        <td class="py-2">{{ $program->degree_text }}</td>
                                        <td class="py-2">{{ $program->duration_text }}</td>
                                        <td class="py-2">{{ $program->sort_order }}</td>
                                        <td class="py-2">{{ $program->is_active ? 'Yes' : 'No' }}</td>
                                        <td class="py-2 text-right">
                                            <a href="{{ route('admin.landing.programs.edit', $program) }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Edit</a>
                                            <form method="POST" action="{{ route('admin.landing.programs.destroy', $program) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-3 text-red-600 hover:underline dark:text-red-400" onclick="return confirm('Delete this item?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 text-center text-gray-500">No programs yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
