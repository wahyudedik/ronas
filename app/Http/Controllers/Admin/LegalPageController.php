<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\LegalPage;
use App\Models\LegalPageVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LegalPageController extends Controller
{
    public function index()
    {
        $pages = LegalPage::all();
        return view('admin.legal.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.legal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('legal_pages')],
            'content' => 'required',
            'status' => 'required|in:published,draft',
        ]);

        $page = LegalPage::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'version' => 1,
            'published_at' => $validated['status'] === 'published' ? now() : null,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        // Create initial version
        LegalPageVersion::create([
            'legal_page_id' => $page->id,
            'content' => $page->content,
            'version' => 1,
            'created_by' => Auth::id(),
        ]);

        // Log audit
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'model_type' => LegalPage::class,
            'model_id' => $page->id,
            'description' => "Created legal page: {$page->title}",
            'changes' => $page->toArray(),
        ]);

        return redirect()->route('admin.legal.pages.index')->with('success', 'Legal page created successfully.');
    }

    public function edit(LegalPage $page)
    {
        return view('admin.legal.edit', ['legalPage' => $page]);
    }

    public function update(Request $request, LegalPage $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('legal_pages')->ignore($page->id)],
            'content' => 'required',
            'status' => 'required|in:published,draft',
        ]);

        $oldData = $page->toArray();

        // Check if content changed to create a new version
        if ($page->content !== $validated['content']) {
            $newVersion = $page->version + 1;

            LegalPageVersion::create([
                'legal_page_id' => $page->id,
                'content' => $validated['content'],
                'version' => $newVersion,
                'created_by' => Auth::id(),
            ]);

            $page->version = $newVersion;
        }

        $page->title = $validated['title'];
        $page->slug = Str::slug($validated['slug']);
        $page->content = $validated['content'];
        $page->status = $validated['status'];

        if ($validated['status'] === 'published' && !$page->published_at) {
            $page->published_at = now();
        }

        $page->updated_by = Auth::id();
        $page->save();

        // Log audit
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'model_type' => LegalPage::class,
            'model_id' => $page->id,
            'description' => "Updated legal page: {$page->title}",
            'changes' => [
                'old' => $oldData,
                'new' => $page->toArray(),
            ],
        ]);

        return redirect()->route('admin.legal.pages.index')->with('success', 'Legal page updated successfully.');
    }

    public function destroy(LegalPage $page)
    {
        $page->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'model_type' => LegalPage::class,
            'model_id' => $page->id,
            'description' => "Deleted legal page: {$page->title}",
        ]);

        return redirect()->route('admin.legal.pages.index')->with('success', 'Legal page deleted successfully.');
    }
}
