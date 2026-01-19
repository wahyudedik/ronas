@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $campusVisitSetting->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $campusVisitSetting->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Image</label>
        <input type="file" name="image" class="w-full rounded-md border-gray-300" />
        @if(!empty($campusVisitSetting?->image))
            <p class="text-xs text-gray-500 mt-1">Current: {{ $campusVisitSetting->image }}</p>
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Image Caption</label>
        <input type="text" name="image_caption" value="{{ old('image_caption', $campusVisitSetting->image_caption ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Button Label</label>
        <input type="text" name="button_label" value="{{ old('button_label', $campusVisitSetting->button_label ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Button URL</label>
        <input type="text" name="button_url" value="{{ old('button_url', $campusVisitSetting->button_url ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Virtual Label</label>
        <input type="text" name="virtual_label" value="{{ old('virtual_label', $campusVisitSetting->virtual_label ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Virtual URL</label>
        <input type="text" name="virtual_url" value="{{ old('virtual_url', $campusVisitSetting->virtual_url ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $campusVisitSetting->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
