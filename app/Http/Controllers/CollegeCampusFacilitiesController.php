<?php

namespace App\Http\Controllers;

use App\Models\CampusFacilityCategory;
use App\Models\CampusHighlight;
use App\Models\CampusMapAction;
use App\Models\CampusMapCategory;
use App\Models\CampusMapSetting;
use App\Models\CampusVirtualTour;
use Illuminate\View\View;

class CollegeCampusFacilitiesController extends Controller
{
    public function index(): View
    {
        $categories = CampusFacilityCategory::query()
            ->with(['items' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
            }])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $virtualTour = CampusVirtualTour::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $virtualTourFeatures = $virtualTour
            ? $virtualTour->features()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        $highlights = CampusHighlight::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $mapSetting = CampusMapSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $mapCategories = CampusMapCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $mapActions = CampusMapAction::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('college.campus-facilities', compact(
            'categories',
            'virtualTour',
            'virtualTourFeatures',
            'highlights',
            'mapSetting',
            'mapCategories',
            'mapActions'
        ));
    }
}
