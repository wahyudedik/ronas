<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutCoreValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutCoreValueController extends Controller
{
    public function index(): View
    {
        $coreValues = AboutCoreValue::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.about.core-values.index', compact('coreValues'));
    }

    public function create(): View
    {
        return view('admin.about.core-values.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCoreValue($request);

        AboutCoreValue::create($validated);

        return redirect()
            ->route('admin.about.core-values.index')
            ->with('status', 'Core value saved.');
    }

    public function edit(AboutCoreValue $coreValue): View
    {
        return view('admin.about.core-values.edit', compact('coreValue'));
    }

    public function update(Request $request, AboutCoreValue $coreValue): RedirectResponse
    {
        $validated = $this->validateCoreValue($request);

        $coreValue->update($validated);

        return redirect()
            ->route('admin.about.core-values.index')
            ->with('status', 'Core value updated.');
    }

    public function destroy(AboutCoreValue $coreValue): RedirectResponse
    {
        $coreValue->delete();

        return redirect()
            ->route('admin.about.core-values.index')
            ->with('status', 'Core value deleted.');
    }

    public function toggle(Request $request, AboutCoreValue $coreValue): JsonResponse|RedirectResponse
    {
        $coreValue->update(['is_active' => ! $coreValue->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $coreValue->is_active]);
        }

        return redirect()
            ->route('admin.about.core-values.index')
            ->with('status', 'Core value visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AboutCoreValue::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.about.core-values.index')
            ->with('status', 'Core value order updated.');
    }

    private function validateCoreValue(Request $request): array
    {
        $validated = $request->validate([
            'icon_class' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        return $validated;
    }
}
