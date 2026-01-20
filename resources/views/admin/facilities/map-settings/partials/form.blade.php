@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $mapSetting->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $mapSetting->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Embed URL</label>
        <input type="text" name="embed_url" value="{{ old('embed_url', $mapSetting->embed_url ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Location Title</label>
            <input type="text" name="location_title" value="{{ old('location_title', $mapSetting->location_title ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Location Address</label>
            <input type="text" name="location_address" value="{{ old('location_address', $mapSetting->location_address ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stat One Icon</label>
            <input type="text" name="stat_one_icon" value="{{ old('stat_one_icon', $mapSetting->stat_one_icon ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stat One Label</label>
            <input type="text" name="stat_one_label" value="{{ old('stat_one_label', $mapSetting->stat_one_label ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stat Two Icon</label>
            <input type="text" name="stat_two_icon" value="{{ old('stat_two_icon', $mapSetting->stat_two_icon ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stat Two Label</label>
            <input type="text" name="stat_two_label" value="{{ old('stat_two_label', $mapSetting->stat_two_label ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $mapSetting->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
