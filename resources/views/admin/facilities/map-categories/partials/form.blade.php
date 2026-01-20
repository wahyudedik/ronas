@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $mapCategory->name ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Key</label>
        <input type="text" name="key" value="{{ old('key', $mapCategory->key ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Icon Class</label>
        <input type="text" name="icon_class" value="{{ old('icon_class', $mapCategory->icon_class ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $mapCategory->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $mapCategory->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
