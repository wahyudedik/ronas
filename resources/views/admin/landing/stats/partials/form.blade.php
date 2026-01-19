@php
    $stat = $stat ?? null;
@endphp

<div>
    <label class="block text-sm font-medium">Label</label>
    <input name="label" class="mt-1 w-full rounded border-gray-300" value="{{ old('label', $stat->label ?? '') }}" required>
    <x-input-error :messages="$errors->get('label')" class="mt-2" />
</div>
<div>
    <label class="block text-sm font-medium">Description</label>
    <input name="description" class="mt-1 w-full rounded border-gray-300" value="{{ old('description', $stat->description ?? '') }}">
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium">Value</label>
        <input name="value" class="mt-1 w-full rounded border-gray-300" value="{{ old('value', $stat->value ?? '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Suffix</label>
        <input name="suffix" class="mt-1 w-full rounded border-gray-300" value="{{ old('suffix', $stat->suffix ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Icon Class</label>
        <input name="icon_class" class="mt-1 w-full rounded border-gray-300" value="{{ old('icon_class', $stat->icon_class ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Sort Order</label>
        <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $stat->sort_order ?? 0) }}">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $stat->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="text-sm">Active</label>
    </div>
</div>
