<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($donation) ? __('Edit Campaign') : __('Create Campaign') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ isset($donation) ? route('admin.alumni.donations.update', $donation) : route('admin.alumni.donations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($donation))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="campaign_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Campaign Name</label>
                                <input type="text" name="campaign_name" id="campaign_name" value="{{ old('campaign_name', $donation->campaign_name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                                @error('campaign_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="target_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Target Amount ($)</label>
                                <input type="number" name="target_amount" id="target_amount" step="0.01" value="{{ old('target_amount', $donation->target_amount ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                                @error('target_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="current_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Amount ($)</label>
                                <input type="number" name="current_amount" id="current_amount" step="0.01" value="{{ old('current_amount', $donation->current_amount ?? '0') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                @error('current_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deadline</label>
                                <input type="date" name="deadline" id="deadline" value="{{ old('deadline', isset($donation) && $donation->deadline ? $donation->deadline->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                @error('deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="is_active" id="is_active" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                    <option value="1" {{ (old('is_active', $donation->is_active ?? '1') == '1') ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ (old('is_active', $donation->is_active ?? '') == '0') ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">{{ old('description', $donation->description ?? '') }}</textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-6">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image</label>
                            @if(isset($donation) && $donation->featured_image)
                                <div class="mb-2">
                                    <img src="{{ asset($donation->featured_image) }}" alt="Current Image" class="h-20 w-auto rounded">
                                </div>
                            @endif
                            <input type="file" name="featured_image" id="featured_image" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100">
                            @error('featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('admin.alumni.donations.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mr-2 hover:bg-gray-400">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                {{ isset($donation) ? 'Update Campaign' : 'Create Campaign' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
