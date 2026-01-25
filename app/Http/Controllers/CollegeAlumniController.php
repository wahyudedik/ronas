<?php

namespace App\Http\Controllers;

use App\Models\AlumniStory;
use App\Models\AlumniEvent;
use App\Models\GetInvolvedOption;
use App\Models\DonationCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CollegeAlumniController extends Controller
{
    public function index()
    {
        $featuredStories = AlumniStory::where('status', 'approved')
            ->latest()
            ->take(5)
            ->get();

        $upcomingEvents = AlumniEvent::where('is_active', true)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->take(3)
            ->get();

        $involvedOptions = GetInvolvedOption::where('is_active', true)
            ->take(4)
            ->get();

        $campaigns = DonationCampaign::where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->take(3)
            ->get();

        return view('college.alumni', compact('featuredStories', 'upcomingEvents', 'involvedOptions', 'campaigns'));
    }

    public function storyDetail(AlumniStory $story)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($story->status !== 'approved' && Auth::id() !== $story->user_id && !$user?->hasRole('admin')) {
            abort(404);
        }

        return view('college.alumni.story-detail', compact('story'));
    }

    public function submitStory(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'alumni_name' => 'required|string|max:255',
                'graduation_year' => 'required|integer|digits:4',
                'content' => 'required|string',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $validated['slug'] = Str::slug($validated['title']) . '-' . time(); // Ensure unique slug
            $validated['status'] = 'pending';
            $validated['user_id'] = Auth::id();

            if ($request->hasFile('featured_image')) {
                $path = $request->file('featured_image')->store('alumni/stories', 'public');
                $validated['featured_image'] = 'storage/' . $path;
            }

            AlumniStory::create($validated);

            return redirect()->route('college.alumni.index')->with('success', 'Your story has been submitted and is pending approval.');
        }

        return view('college.alumni.submit-story');
    }

    public function events()
    {
        $events = AlumniEvent::where('is_active', true)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->paginate(9);

        return view('college.alumni.events', compact('events'));
    }

    public function eventDetail(AlumniEvent $event)
    {
        if (!$event->is_active) {
            abort(404);
        }
        return view('college.alumni.event-detail', compact('event'));
    }

    public function donate(?DonationCampaign $campaign = null)
    {
        if ($campaign && (!$campaign->is_active || $campaign->deadline < now())) {
            return redirect()->route('college.alumni.index')->with('error', 'This campaign is no longer active.');
        }

        $campaigns = DonationCampaign::where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->get();

        return view('college.alumni.donate', compact('campaign', 'campaigns'));
    }

    public function processDonation(Request $request)
    {
        // This is a mock implementation for demonstration
        $validated = $request->validate([
            'campaign_id' => 'required|exists:donation_campaigns,id',
            'amount' => 'required|numeric|min:1',
            'donor_name' => 'required|string|max:255',
            'email' => 'required|email',
            'payment_method' => 'required|string',
        ]);

        $campaign = DonationCampaign::find($validated['campaign_id']);
        $campaign->increment('current_amount', $validated['amount']);

        return redirect()->back()->with('success', 'Thank you for your donation of $' . number_format($validated['amount'], 2) . '!');
    }
}
