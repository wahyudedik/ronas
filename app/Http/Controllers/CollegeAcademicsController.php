<?php

namespace App\Http\Controllers;

use App\Models\AcademicsFacultyHighlight;
use App\Models\LandingProgram;
use Illuminate\View\View;

class CollegeAcademicsController extends Controller
{
    public function index(): View
    {
        $programLevels = [
            'undergraduate' => 'Undergraduate',
            'graduate' => 'Graduate',
            'certificate' => 'Certificate',
        ];

        $programs = LandingProgram::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $programCounts = $programs
            ->groupBy('program_level')
            ->map(fn ($items) => $items->count());

        $facultyHighlights = AcademicsFacultyHighlight::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('college.academics', compact('programs', 'programLevels', 'programCounts', 'facultyHighlights'));
    }
}
