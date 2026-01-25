<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniStory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Mews\Purifier\Facades\Purifier;

class AlumniStoryController extends Controller
{
    public function index()
    {
        $stories = AlumniStory::latest()->paginate(10);
        return view('admin.alumni.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.alumni.stories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'alumni_name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|digits:4',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        // Sanitize content
        $validated['content'] = clean($validated['content']);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('alumni/stories', 'public');
            $validated['featured_image'] = 'storage/' . $path;
        }

        AlumniStory::create($validated);

        return redirect()->route('admin.alumni.stories.index')->with('success', 'Story created successfully.');
    }

    public function edit(AlumniStory $story)
    {
        return view('admin.alumni.stories.edit', compact('story'));
    }

    public function update(Request $request, AlumniStory $story)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'alumni_name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|digits:4',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        // Sanitize content
        $validated['content'] = clean($validated['content']);

        if ($story->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            if ($story->featured_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $story->featured_image));
            }
            $path = $request->file('featured_image')->store('alumni/stories', 'public');
            $validated['featured_image'] = 'storage/' . $path;
        }

        $story->update($validated);

        return redirect()->route('admin.alumni.stories.index')->with('success', 'Story updated successfully.');
    }

    public function destroy(AlumniStory $story)
    {
        if ($story->featured_image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $story->featured_image));
        }
        $story->delete();

        return redirect()->route('admin.alumni.stories.index')->with('success', 'Story deleted successfully.');
    }
}
