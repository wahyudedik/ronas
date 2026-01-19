@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $requestInfoSetting->title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Form Action</label>
        <input type="text" name="form_action" value="{{ old('form_action', $requestInfoSetting->form_action ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Program Placeholder</label>
        <input type="text" name="program_placeholder" value="{{ old('program_placeholder', $requestInfoSetting->program_placeholder ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Submit Label</label>
        <input type="text" name="submit_label" value="{{ old('submit_label', $requestInfoSetting->submit_label ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $requestInfoSetting->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
