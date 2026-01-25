<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GetInvolvedOption;
use Illuminate\Http\Request;

class GetInvolvedController extends Controller
{
    public function index()
    {
        $options = GetInvolvedOption::latest()->paginate(10);
        return view('admin.alumni.involved.index', compact('options'));
    }

    public function create()
    {
        return view('admin.alumni.involved.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:255',
            'requirements' => 'nullable|string',
            'contact_info' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        GetInvolvedOption::create($validated);

        return redirect()->route('admin.alumni.involved.index')->with('success', 'Option created successfully.');
    }

    public function edit(GetInvolvedOption $involved)
    {
        return view('admin.alumni.involved.edit', compact('involved'));
    }

    public function update(Request $request, GetInvolvedOption $involved)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:255',
            'requirements' => 'nullable|string',
            'contact_info' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $involved->update($validated);

        return redirect()->route('admin.alumni.involved.index')->with('success', 'Option updated successfully.');
    }

    public function destroy(GetInvolvedOption $involved)
    {
        $involved->delete();
        return redirect()->route('admin.alumni.involved.index')->with('success', 'Option deleted successfully.');
    }
}
