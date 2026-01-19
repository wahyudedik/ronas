@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Leadership Section</label>
        <select name="about_leadership_section_id" class="w-full rounded-md border-gray-300">
            @foreach($sections as $section)
                <option value="{{ $section->id }}" {{ (string) old('about_leadership_section_id', $leadershipHighlight->about_leadership_section_id ?? $sectionId ?? '') === (string) $section->id ? 'selected' : '' }}>
                    {{ $section->title ?? 'Section #' . $section->id }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Icon Class</label>
        <input type="text" name="icon_class" value="{{ old('icon_class', $leadershipHighlight->icon_class ?? '') }}" class="w-full rounded-md border-gray-300" placeholder="bi bi-mortarboard-fill" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $leadershipHighlight->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $leadershipHighlight->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $leadershipHighlight->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $leadershipHighlight->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
