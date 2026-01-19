@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Page Title</label>
        <input type="text" name="page_title" value="{{ old('page_title', $pageSetting->page_title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Breadcrumb Title</label>
        <input type="text" name="breadcrumb_title" value="{{ old('breadcrumb_title', $pageSetting->breadcrumb_title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Steps Title</label>
        <input type="text" name="steps_title" value="{{ old('steps_title', $pageSetting->steps_title ?? '') }}" class="w-full rounded-md border-gray-300" />
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $pageSetting->is_active ?? false) ? 'checked' : '' }} />
        <span class="text-sm">Active</span>
    </div>
</div>
