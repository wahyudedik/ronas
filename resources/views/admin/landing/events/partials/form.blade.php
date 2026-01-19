@php
    $event = $event ?? null;
@endphp

<div>
    <label class="block text-sm font-medium">Title</label>
    <input name="title" class="mt-1 w-full rounded border-gray-300" value="{{ old('title', $event->title ?? '') }}" required>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Category</label>
        <input name="category" class="mt-1 w-full rounded border-gray-300" value="{{ old('category', $event->category ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Time Text</label>
        <input name="time_text" class="mt-1 w-full rounded border-gray-300" value="{{ old('time_text', $event->time_text ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Date Day</label>
        <input name="date_day" class="mt-1 w-full rounded border-gray-300" value="{{ old('date_day', $event->date_day ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Date Month</label>
        <input name="date_month" class="mt-1 w-full rounded border-gray-300" value="{{ old('date_month', $event->date_month ?? '') }}">
    </div>
</div>
<div>
    <label class="block text-sm font-medium">Description</label>
    <textarea name="description" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('description', $event->description ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Location</label>
        <input name="location" class="mt-1 w-full rounded border-gray-300" value="{{ old('location', $event->location ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Participants</label>
        <input name="participants" class="mt-1 w-full rounded border-gray-300" value="{{ old('participants', $event->participants ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($event?->image))
            <img src="{{ asset(ltrim($event->image, '/')) }}" alt="Event image" class="mt-2 h-20 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">Link URL</label>
        <input name="link_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('link_url', $event->link_url ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Sort Order</label>
        <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $event->sort_order ?? 0) }}">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $event->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="text-sm">Active</label>
    </div>
</div>
