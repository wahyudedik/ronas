@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $virtualTour->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $virtualTour->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Badge Text</label>
        <input type="text" name="badge_text" value="{{ old('badge_text', $virtualTour->badge_text ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Video URL</label>
        <input type="text" name="video_url" value="{{ old('video_url', $virtualTour->video_url ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Primary Label</label>
            <input type="text" name="primary_label" value="{{ old('primary_label', $virtualTour->primary_label ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Primary URL</label>
            <input type="text" name="primary_url" value="{{ old('primary_url', $virtualTour->primary_url ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Secondary Label</label>
            <input type="text" name="secondary_label" value="{{ old('secondary_label', $virtualTour->secondary_label ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Secondary URL</label>
            <input type="text" name="secondary_url" value="{{ old('secondary_url', $virtualTour->secondary_url ?? '') }}" class="w-full rounded-md border-gray-300" />
        </div>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $virtualTour->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
