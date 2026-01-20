@php
    $program = $program ?? null;
@endphp

<div>
    <label class="block text-sm font-medium">Title</label>
    <input name="title" class="mt-1 w-full rounded border-gray-300" value="{{ old('title', $program->title ?? '') }}" required>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div>
    <label class="block text-sm font-medium">Description</label>
    <textarea name="description" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('description', $program->description ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Duration</label>
        <input name="duration_text" class="mt-1 w-full rounded border-gray-300" value="{{ old('duration_text', $program->duration_text ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Degree</label>
        <input name="degree_text" class="mt-1 w-full rounded border-gray-300" value="{{ old('degree_text', $program->degree_text ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Program Level</label>
        <select name="program_level" class="mt-1 w-full rounded border-gray-300">
            @php
                $currentLevel = old('program_level', $program->program_level ?? 'undergraduate');
            @endphp
            <option value="undergraduate" {{ $currentLevel === 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
            <option value="graduate" {{ $currentLevel === 'graduate' ? 'selected' : '' }}>Graduate</option>
            <option value="certificate" {{ $currentLevel === 'certificate' ? 'selected' : '' }}>Certificate</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded border-gray-300">
        @if(!empty($program?->image))
            <img src="{{ asset(ltrim($program->image, '/')) }}" alt="Program image" class="mt-2 h-20 rounded object-cover">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium">Badge Text</label>
        <input name="badge_text" class="mt-1 w-full rounded border-gray-300" value="{{ old('badge_text', $program->badge_text ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Meta One</label>
        <input name="meta_one" class="mt-1 w-full rounded border-gray-300" value="{{ old('meta_one', $program->meta_one ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium">Meta Two</label>
        <input name="meta_two" class="mt-1 w-full rounded border-gray-300" value="{{ old('meta_two', $program->meta_two ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Sort Order</label>
        <input name="sort_order" type="number" class="mt-1 w-full rounded border-gray-300" value="{{ old('sort_order', $program->sort_order ?? 0) }}">
    </div>
    <div class="flex items-center gap-4 mt-6">
        <label class="inline-flex items-center gap-2">
            <input name="is_featured" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_featured', $program->is_featured ?? false) ? 'checked' : '' }}>
            <span class="text-sm">Featured</span>
        </label>
        <label class="inline-flex items-center gap-2">
            <input name="is_active" type="checkbox" value="1" class="rounded border-gray-300" {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }}>
            <span class="text-sm">Active</span>
        </label>
    </div>
</div>
