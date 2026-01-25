<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function index()
    {
        $settings = ContactSetting::all();
        return view('admin.contact.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        foreach ($validated['settings'] as $key => $value) {
            ContactSetting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->route('admin.contact.settings.index')->with('success', 'Settings updated successfully.');
    }
}
