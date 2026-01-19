@csrf

@php
    $links = isset($leadershipMember) ? ($leadershipMember->social_links ?? []) : [];
@endphp

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Leadership Section</label>
        <select name="about_leadership_section_id" class="w-full rounded-md border-gray-300">
            @foreach($sections as $section)
                <option value="{{ $section->id }}" {{ (string) old('about_leadership_section_id', $leadershipMember->about_leadership_section_id ?? $sectionId ?? '') === (string) $section->id ? 'selected' : '' }}>
                    {{ $section->title ?? 'Section #' . $section->id }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $leadershipMember->name ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Role</label>
        <input type="text" name="role" value="{{ old('role', $leadershipMember->role ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Bio</label>
        <textarea name="bio" rows="4" class="w-full rounded-md border-gray-300">{{ old('bio', $leadershipMember->bio ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Image</label>
        <input type="file" name="image" class="w-full rounded-md border-gray-300" />
        @if(!empty($leadershipMember?->image))
            <p class="text-xs text-gray-500 mt-1">Current: {{ $leadershipMember->image }}</p>
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">LinkedIn URL</label>
        <input type="text" name="social_linkedin" value="{{ old('social_linkedin', $links['linkedin'] ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Twitter/X URL</label>
        <input type="text" name="social_twitter" value="{{ old('social_twitter', $links['twitter'] ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="text" name="social_email" value="{{ old('social_email', $links['email'] ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $leadershipMember->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $leadershipMember->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
