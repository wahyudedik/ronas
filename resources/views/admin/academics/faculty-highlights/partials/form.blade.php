@php
    $facultyHighlight = $facultyHighlight ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Name</label>
        <input name="name" class="mt-1 w-full rounded border-gray-300" value="{{ old('name', $facultyHighlight->name ?? '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Role</label>
        <input name="role" class="mt-1 w-full rounded border-gray-300" value="{{ old('role', $facultyHighlight->role ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($facultyHighlight?->image))
            <img src="{{ asset(ltrim($facultyHighlight->image, '/')) }}" alt="Faculty image" class="mt-2 h-20 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">LinkedIn URL</label>
        <input name="linkedin_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('linkedin_url', $facultyHighlight->linkedin_url ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Twitter/X URL</label>
        <input name="twitter_url" class="mt-1 w-full rounded border-gray-300" value="{{ old('twitter_url', $facultyHighlight->twitter_url ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Email</label>
        <input name="email" class="mt-1 w-full rounded border-gray-300" value="{{ old('email', $facultyHighlight->email ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
    <div>
        <label class="block text-sm font-medium">Sort Order</label>
        <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $facultyHighlight->sort_order ?? 0) }}">
    </div>
    <div class="flex items-center gap-4 mt-6">
        <label class="inline-flex items-center gap-2">
            <input name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $facultyHighlight->is_active ?? true) ? 'checked' : '' }}>
            <span class="text-sm">Active</span>
        </label>
    </div>
</div>
