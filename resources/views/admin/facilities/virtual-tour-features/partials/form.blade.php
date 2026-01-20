@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Virtual Tour</label>
        <select name="campus_virtual_tour_id" class="w-full rounded-md border-gray-300">
            @foreach ($tours as $tour)
                <option value="{{ $tour->id }}" {{ (int) old('campus_virtual_tour_id', $feature->campus_virtual_tour_id ?? 0) === $tour->id ? 'selected' : '' }}>
                    {{ $tour->title ?? 'Virtual Tour #' . $tour->id }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $feature->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <input type="text" name="description" value="{{ old('description', $feature->description ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Icon Class</label>
        <input type="text" name="icon_class" value="{{ old('icon_class', $feature->icon_class ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $feature->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $feature->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
