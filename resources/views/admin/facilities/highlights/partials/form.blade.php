@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $highlight->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Category Label</label>
        <input type="text" name="category_label" value="{{ old('category_label', $highlight->category_label ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $highlight->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Image</label>
        <input type="file" name="image" class="w-full rounded-md border-gray-300" />
        @if (!empty($highlight?->image))
            <p class="text-xs text-gray-500 mt-1">Current: {{ $highlight->image }}</p>
        @endif
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Stat One Icon</label>
            <input type="text" name="stat_one_icon" value="{{ old('stat_one_icon', $highlight->stat_one_icon ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stat One Label</label>
            <input type="text" name="stat_one_label" value="{{ old('stat_one_label', $highlight->stat_one_label ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stat Two Icon</label>
            <input type="text" name="stat_two_icon" value="{{ old('stat_two_icon', $highlight->stat_two_icon ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stat Two Label</label>
            <input type="text" name="stat_two_label" value="{{ old('stat_two_label', $highlight->stat_two_label ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $highlight->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $highlight->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
