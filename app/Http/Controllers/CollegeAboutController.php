<?php

namespace App\Http\Controllers;

use App\Models\AboutCoreValue;
use App\Models\AboutHistory;
use App\Models\AboutLeadershipSection;
use App\Models\AboutMissionVision;
use Illuminate\View\View;

class CollegeAboutController extends Controller
{
    public function index(): View
    {
        $history = AboutHistory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $milestones = $history
            ? $history->milestones()->where('is_active', true)->get()
            : collect();

        $mission = AboutMissionVision::query()
            ->where('type', 'mission')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $vision = AboutMissionVision::query()
            ->where('type', 'vision')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $coreValues = AboutCoreValue::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $leadershipSection = AboutLeadershipSection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $leadershipHighlights = $leadershipSection
            ? $leadershipSection->highlights()->where('is_active', true)->get()
            : collect();

        $leadershipMembers = $leadershipSection
            ? $leadershipSection->members()->where('is_active', true)->get()
            : collect();

        return view('college.about', compact(
            'history',
            'milestones',
            'mission',
            'vision',
            'coreValues',
            'leadershipSection',
            'leadershipHighlights',
            'leadershipMembers'
        ));
    }
}
