<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutLeadershipMember;
use App\Models\AboutLeadershipSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutLeadershipMemberController extends Controller
{
    public function index(Request $request): View
    {
        $sectionId = $request->query('section_id');

        $members = AboutLeadershipMember::query()
            ->when($sectionId, fn ($query) => $query->where('about_leadership_section_id', $sectionId))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        $sections = AboutLeadershipSection::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.about.leadership-members.index', compact('members', 'sections', 'sectionId'));
    }

    public function create(Request $request): View
    {
        $sections = AboutLeadershipSection::query()->orderBy('sort_order')->orderBy('id')->get();
        $sectionId = $request->query('section_id');

        return view('admin.about.leadership-members.create', compact('sections', 'sectionId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateMember($request);
        $this->handleImageUpload($request, $validated);
        $validated['social_links'] = $this->buildSocialLinks($request);

        AboutLeadershipMember::create($validated);

        return redirect()
            ->route('admin.about.leadership-members.index', ['section_id' => $validated['about_leadership_section_id']])
            ->with('status', 'Leadership member saved.');
    }

    public function edit(AboutLeadershipMember $leadershipMember): View
    {
        $sections = AboutLeadershipSection::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.about.leadership-members.edit', compact('leadershipMember', 'sections'));
    }

    public function update(Request $request, AboutLeadershipMember $leadershipMember): RedirectResponse
    {
        $validated = $this->validateMember($request);
        $this->handleImageUpload($request, $validated, $leadershipMember->image);
        $validated['social_links'] = $this->buildSocialLinks($request);

        $leadershipMember->update($validated);

        return redirect()
            ->route('admin.about.leadership-members.index', ['section_id' => $validated['about_leadership_section_id']])
            ->with('status', 'Leadership member updated.');
    }

    public function destroy(AboutLeadershipMember $leadershipMember): RedirectResponse
    {
        $this->deleteOldImage($leadershipMember->image);
        $sectionId = $leadershipMember->about_leadership_section_id;
        $leadershipMember->delete();

        return redirect()
            ->route('admin.about.leadership-members.index', ['section_id' => $sectionId])
            ->with('status', 'Leadership member deleted.');
    }

    public function toggle(Request $request, AboutLeadershipMember $leadershipMember): JsonResponse|RedirectResponse
    {
        $leadershipMember->update(['is_active' => ! $leadershipMember->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['is_active' => $leadershipMember->is_active]);
        }

        return redirect()
            ->route('admin.about.leadership-members.index', ['section_id' => $leadershipMember->about_leadership_section_id])
            ->with('status', 'Leadership member visibility updated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'string'],
        ]);

        $ids = array_values(array_filter(array_map('intval', explode(',', $request->input('order')))));

        foreach ($ids as $index => $id) {
            AboutLeadershipMember::whereKey($id)->update(['sort_order' => $index + 1]);
        }

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()
            ->route('admin.about.leadership-members.index')
            ->with('status', 'Leadership member order updated.');
    }

    private function validateMember(Request $request): array
    {
        $validated = $request->validate([
            'about_leadership_section_id' => ['required', 'exists:about_leadership_sections,id'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'social_linkedin' => ['nullable', 'string', 'max:255'],
            'social_twitter' => ['nullable', 'string', 'max:255'],
            'social_email' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        unset($validated['social_linkedin'], $validated['social_twitter'], $validated['social_email']);

        return $validated;
    }

    private function buildSocialLinks(Request $request): ?array
    {
        $links = array_filter([
            'linkedin' => $request->input('social_linkedin'),
            'twitter' => $request->input('social_twitter'),
            'email' => $request->input('social_email'),
        ]);

        return $links !== [] ? $links : null;
    }

    private function handleImageUpload(Request $request, array &$validated, ?string $existingImage = null): void
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('about', 'public');
            $validated['image'] = 'storage/' . $path;
            $this->deleteOldImage($existingImage);
        }
    }

    private function deleteOldImage(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'storage/')) {
            return;
        }

        $relative = substr($path, strlen('storage/'));
        if ($relative !== '') {
            Storage::disk('public')->delete($relative);
        }
    }
}
