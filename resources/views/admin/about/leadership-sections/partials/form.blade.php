@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Subtitle</label>
        <input type="text" name="subtitle" value="{{ old('subtitle', $leadershipSection->subtitle ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $leadershipSection->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $leadershipSection->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Image</label>
        <input type="file" name="image" class="w-full rounded-md border-gray-300" />
        @if(!empty($leadershipSection?->image))
            <p class="text-xs text-gray-500 mt-1">Current: {{ $leadershipSection->image }}</p>
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Experience Years</label>
        <input type="text" name="experience_years" value="{{ old('experience_years', $leadershipSection->experience_years ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Experience Text</label>
        <input type="text" name="experience_text" value="{{ old('experience_text', $leadershipSection->experience_text ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $leadershipSection->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $leadershipSection->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
