<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DonationCampaignController extends Controller
{
    public function index()
    {
        $campaigns = DonationCampaign::latest()->paginate(10);
        return view('admin.alumni.donations.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.alumni.donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date',
            'payment_methods' => 'nullable|array',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['campaign_name']);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('alumni/donations', 'public');
            $validated['featured_image'] = 'storage/' . $path;
        }
        
        // Ensure payment_methods is an array even if not provided
        $validated['payment_methods'] = $validated['payment_methods'] ?? [];

        DonationCampaign::create($validated);

        return redirect()->route('admin.alumni.donations.index')->with('success', 'Campaign created successfully.');
    }

    public function edit(DonationCampaign $donation)
    {
        return view('admin.alumni.donations.edit', compact('donation'));
    }

    public function update(Request $request, DonationCampaign $donation)
    {
        $validated = $request->validate([
            'campaign_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date',
            'payment_methods' => 'nullable|array',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($donation->campaign_name !== $validated['campaign_name']) {
            $validated['slug'] = Str::slug($validated['campaign_name']);
        }

        if ($request->hasFile('featured_image')) {
            if ($donation->featured_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $donation->featured_image));
            }
            $path = $request->file('featured_image')->store('alumni/donations', 'public');
            $validated['featured_image'] = 'storage/' . $path;
        }

        $donation->update($validated);

        return redirect()->route('admin.alumni.donations.index')->with('success', 'Campaign updated successfully.');
    }

    public function destroy(DonationCampaign $donation)
    {
        if ($donation->featured_image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $donation->featured_image));
        }
        $donation->delete();

        return redirect()->route('admin.alumni.donations.index')->with('success', 'Campaign deleted successfully.');
    }
}
