@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Category</label>
        <select name="category_id" class="w-full rounded-md border-gray-300">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (int) old('category_id', $item->category_id ?? 0) === $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Label</label>
        <input type="text" name="label" value="{{ old('label', $item->label ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Icon Class</label>
        <input type="text" name="icon_class" value="{{ old('icon_class', $item->icon_class ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $item->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
