@php
    $newsItem = $newsItem ?? null;
@endphp

<div>
    <label class="block text-sm font-medium">Title</label>
    <input name="title" class="mt-1 w-full rounded border-gray-300" value="{{ old('title', $newsItem->title ?? '') }}" required>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Category</label>
        <input name="category" class="mt-1 w-full rounded border-gray-300" value="{{ old('category', $newsItem->category ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Published Date</label>
        <input name="published_at" type="date" class="mt-1 w-full rounded border-gray-300" value="{{ old('published_at', optional($newsItem->published_at)->format('Y-m-d')) }}">
    </div>
</div>
<div>
    <label class="block text-sm font-medium">Excerpt</label>
    <textarea name="excerpt" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('excerpt', $newsItem->excerpt ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Author Name</label>
        <input name="author_name" class="mt-1 w-full rounded border-gray-300" value="{{ old('author_name', $newsItem->author_name ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Author Image</label>
        <input name="author_image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($newsItem?->author_image))
            <img src="{{ asset(ltrim($newsItem->author_image, '/')) }}" alt="Author image" class="mt-2 h-16 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($newsItem?->image))
            <img src="{{ asset(ltrim($newsItem->image, '/')) }}" alt="News image" class="mt-2 h-20 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">Link URL</label>
        <input name="link_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('link_url', $newsItem->link_url ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Sort Order</label>
        <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $newsItem->sort_order ?? 0) }}">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $newsItem->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="text-sm">Active</label>
    </div>
</div>
