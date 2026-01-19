@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">History</label>
        <select name="about_history_id" class="w-full rounded-md border-gray-300">
            @foreach($histories as $history)
                <option value="{{ $history->id }}" {{ (string) old('about_history_id', $milestone->about_history_id ?? $historyId ?? '') === (string) $history->id ? 'selected' : '' }}>
                    {{ $history->title ?? 'History #' . $history->id }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Year</label>
        <input type="text" name="year" value="{{ old('year', $milestone->year ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300">{{ old('description', $milestone->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $milestone->sort_order ?? 0) }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $milestone->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
