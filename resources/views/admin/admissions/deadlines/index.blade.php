<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Deadlines
            </h2>
            <a href="{{ route('admin.admissions.deadlines.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold">
                Add Deadline
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
                                    <th class="py-2 w-8"></th>
                                    <th class="py-2">Date</th>
                                    <th class="py-2">Title</th>
                                    <th class="py-2">Order</th>
                                    <th class="py-2">Active</th>
                                    <th class="py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="deadlines-sortable" class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($deadlines as $deadline)
                                    <tr data-id="{{ $deadline->id }}">
                                        <td class="py-2">
                                            @include('admin.landing.partials.drag-handle')
                                        </td>
                                        <td class="py-2">{{ $deadline->date_text }}</td>
                                        <td class="py-2">{{ $deadline->title }}</td>
                                        <td class="py-2">{{ $deadline->sort_order }}</td>
                                        <td class="py-2">
                                            <form action="{{ route('admin.admissions.deadlines.toggle', $deadline) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <label class="inline-flex items-center gap-2">
                                                    <input type="checkbox" class="js-toggle rounded border-gray-300" {{ $deadline->is_active ? 'checked' : '' }}>
                                                    <span class="text-sm">{{ $deadline->is_active ? 'Active' : 'Inactive' }}</span>
                                                </label>
                                            </form>
                                        </td>
                                        <td class="py-2 text-right">
                                            <a href="{{ route('admin.admissions.deadlines.edit', $deadline) }}" class="text-indigo-600 hover:underline">Edit</a>
                                            <form action="{{ route('admin.admissions.deadlines.destroy', $deadline) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-3 text-red-600 hover:underline" onclick="return confirm('Delete this deadline?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $deadlines->links() }}
                    </div>

                    <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <button id="deadlines-undo-btn" type="button" class="hidden rounded-md border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                            Undo last reorder
                        </button>
                    </div>

                    <form id="deadlines-order-form" method="POST" action="{{ route('admin.admissions.deadlines.reorder') }}">
                        @csrf
                        <input type="hidden" name="order" id="deadlines-order-input">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        (function () {
            const tbody = document.getElementById('deadlines-sortable');
            const input = document.getElementById('deadlines-order-input');
            const form = document.getElementById('deadlines-order-form');

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
            const undoBtn = document.getElementById('deadlines-undo-btn');
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
</x-app-layout>
