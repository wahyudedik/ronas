<?php

namespace App\Http\Controllers;

use App\Models\LandingStudentLifeItem;
use App\Models\StudentLifeSectionSetting;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CollegeStudentsLifeController extends Controller
{
    public function index(): View
    {
        $items = LandingStudentLifeItem::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        $sections = StudentLifeSectionSetting::query()
            ->orderBy('id')
            ->get()
            ->keyBy('key');

        $getItems = fn (string $category): Collection => $items->get($category, collect());

        return view('college.students-life', [
            'organizations' => $getItems('organizations'),
            'athletics' => $getItems('athletics'),
            'facilities' => $getItems('facilities'),
            'supportServices' => $getItems('support_services'),
            'gallery' => $getItems('gallery'),
            'sections' => $sections,
        ]);
    }
}
