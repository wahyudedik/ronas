@php
    $item = $item ?? null;
@endphp

<div>
    <label class="block text-sm font-medium">Title</label>
    <input name="title" class="mt-1 w-full rounded border-gray-300" value="{{ old('title', $item->title ?? '') }}" required>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div>
    <label class="block text-sm font-medium">Category</label>
    @php
        $currentCategory = old('category', $item->category ?? 'organizations');
    @endphp
    <select name="category" class="mt-1 w-full rounded border-gray-300">
        <option value="organizations" {{ $currentCategory === 'organizations' ? 'selected' : '' }}>Organisasi</option>
        <option value="athletics" {{ $currentCategory === 'athletics' ? 'selected' : '' }}>Atletik</option>
        <option value="facilities" {{ $currentCategory === 'facilities' ? 'selected' : '' }}>Fasilitas</option>
        <option value="support_services" {{ $currentCategory === 'support_services' ? 'selected' : '' }}>Layanan Pendukung</option>
        <option value="gallery" {{ $currentCategory === 'gallery' ? 'selected' : '' }}>Galeri</option>
    </select>
</div>
<div>
    <label class="block text-sm font-medium">Description</label>
    <textarea name="description" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('description', $item->description ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($item?->image))
            <img src="{{ asset(ltrim($item->image, '/')) }}" alt="Student life image" class="mt-2 h-20 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">Gallery Images (multi)</label>
        <input name="gallery_images[]" type="file" accept="image/*" multiple class="mt-1 w-full rounded border-gray-300">
        <p class="text-xs text-gray-500 mt-1">Gunakan untuk kategori Galeri, akan membuat beberapa item sekaligus.</p>
    </div>
    <div>
        <label class="block text-sm font-medium">Icon Class</label>
        <input name="icon_class" class="mt-1 w-full rounded border-gray-300" value="{{ old('icon_class', $item->icon_class ?? '') }}" placeholder="bi bi-stars">
    </div>
    <div>
        <label class="block text-sm font-medium">Badge Text</label>
        <input name="badge_text" class="mt-1 w-full rounded border-gray-300" value="{{ old('badge_text', $item->badge_text ?? '') }}" placeholder="15+ Groups">
    </div>
    <div>
        <label class="block text-sm font-medium">Link Label</label>
        <input name="link_label" class="mt-1 w-full rounded border-gray-300" value="{{ old('link_label', $item->link_label ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Link URL</label>
        <input name="link_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('link_url', $item->link_url ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Sort Order</label>
        <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="text-sm">Active</label>
    </div>
</div>
