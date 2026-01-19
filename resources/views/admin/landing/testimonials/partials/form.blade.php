@php
    $testimonial = $testimonial ?? null;
@endphp

<div>
    <label class="block text-sm font-medium">Name</label>
    <input name="name" class="mt-1 w-full rounded border-gray-300" value="{{ old('name', $testimonial->name ?? '') }}" required>
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>
<div>
    <label class="block text-sm font-medium">Role</label>
    <input name="role" class="mt-1 w-full rounded border-gray-300" value="{{ old('role', $testimonial->role ?? '') }}">
</div>
<div>
    <label class="block text-sm font-medium">Quote</label>
    <textarea name="quote" class="mt-1 w-full rounded border-gray-300" rows="3" required>{{ old('quote', $testimonial->quote ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('quote')" class="mt-2" />
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($testimonial?->image))
            <img src="{{ asset(ltrim($testimonial->image, '/')) }}" alt="Testimonial image" class="mt-2 h-20 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">Rating</label>
        <input name="rating" type="number" min="1" max="5" class="mt-1 w-full rounded border-gray-300" value="{{ old('rating', $testimonial->rating ?? 5) }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Sort Order</label>
        <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}">
    </div>
</div>
<div class="flex items-center gap-2">
    <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
    <label for="is_active" class="text-sm">Active</label>
</div>
