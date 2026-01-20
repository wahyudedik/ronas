@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Theme (CSS class)</label>
        <input type="text" name="theme" value="{{ old('theme', $category->theme ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Icon Class</label>
        <input type="text" name="icon_class" value="{{ old('icon_class', $category->icon_class ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Image</label>
        <input type="file" name="image" class="w-full rounded-md border-gray-300" />
        @if (!empty($category?->image))
            <p class="text-xs text-gray-500 mt-1">Current: {{ $category->image }}</p>
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Button Label</label>
        <input type="text" name="button_label" value="{{ old('button_label', $category->button_label ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Button URL</label>
        <input type="text" name="button_url" value="{{ old('button_url', $category->button_url ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $category->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
