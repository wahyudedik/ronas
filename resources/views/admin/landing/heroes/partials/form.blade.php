@php
    $hero = $hero ?? null;
@endphp

<div>
    <label class="block text-sm font-medium">Title</label>
    <input name="title" class="mt-1 w-full rounded border-gray-300" value="{{ old('title', $hero->title ?? '') }}" required>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div>
    <label class="block text-sm font-medium">Description</label>
    <textarea name="description" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('description', $hero->description ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Primary Label</label>
        <input name="primary_label" class="mt-1 w-full rounded border-gray-300" value="{{ old('primary_label', $hero->primary_label ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Primary URL</label>
        <input name="primary_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('primary_url', $hero->primary_url ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Secondary Label</label>
        <input name="secondary_label" class="mt-1 w-full rounded border-gray-300" value="{{ old('secondary_label', $hero->secondary_label ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Secondary URL</label>
        <input name="secondary_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('secondary_url', $hero->secondary_url ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($hero?->image))
            <img src="{{ asset(ltrim($hero->image, '/')) }}" alt="Hero image" class="mt-2 h-24 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">Badge Text</label>
        <input name="badge_text" class="mt-1 w-full rounded border-gray-300" value="{{ old('badge_text', $hero->badge_text ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Badge Icon (class)</label>
        <input name="badge_icon" class="mt-1 w-full rounded border-gray-300" value="{{ old('badge_icon', $hero->badge_icon ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium">Stat 1 Value</label>
        <input name="stat_one_value" class="mt-1 w-full rounded border-gray-300" value="{{ old('stat_one_value', $hero->stat_one_value ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Stat 1 Label</label>
        <input name="stat_one_label" class="mt-1 w-full rounded border-gray-300" value="{{ old('stat_one_label', $hero->stat_one_label ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Stat 2 Value</label>
        <input name="stat_two_value" class="mt-1 w-full rounded border-gray-300" value="{{ old('stat_two_value', $hero->stat_two_value ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Stat 2 Label</label>
        <input name="stat_two_label" class="mt-1 w-full rounded border-gray-300" value="{{ old('stat_two_label', $hero->stat_two_label ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Stat 3 Value</label>
        <input name="stat_three_value" class="mt-1 w-full rounded border-gray-300" value="{{ old('stat_three_value', $hero->stat_three_value ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Stat 3 Label</label>
        <input name="stat_three_label" class="mt-1 w-full rounded border-gray-300" value="{{ old('stat_three_label', $hero->stat_three_label ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Event Day</label>
        <input name="event_day" class="mt-1 w-full rounded border-gray-300" value="{{ old('event_day', $hero->event_day ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Event Month</label>
        <input name="event_month" class="mt-1 w-full rounded border-gray-300" value="{{ old('event_month', $hero->event_month ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Event Title</label>
        <input name="event_title" class="mt-1 w-full rounded border-gray-300" value="{{ old('event_title', $hero->event_title ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Event Button Label</label>
        <input name="event_button_label" class="mt-1 w-full rounded border-gray-300" value="{{ old('event_button_label', $hero->event_button_label ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Event Button URL</label>
        <input name="event_button_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('event_button_url', $hero->event_button_url ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Event Countdown Text</label>
        <input name="event_countdown_text" class="mt-1 w-full rounded border-gray-300" value="{{ old('event_countdown_text', $hero->event_countdown_text ?? '') }}">
    </div>
</div>
<div>
    <label class="block text-sm font-medium">Event Description</label>
    <textarea name="event_description" class="mt-1 w-full rounded border-gray-300" rows="2">{{ old('event_description', $hero->event_description ?? '') }}</textarea>
</div>
<div class="flex items-center gap-2">
    <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }}>
    <label for="is_active" class="text-sm">Active</label>
</div>
