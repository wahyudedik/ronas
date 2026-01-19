<?php

namespace App\Http\Controllers;

use App\Models\AdmissionsApplicationStep;
use App\Models\AdmissionsCampusVisitOption;
use App\Models\AdmissionsCampusVisitSetting;
use App\Models\AdmissionsDeadline;
use App\Models\AdmissionsDeadlineSetting;
use App\Models\AdmissionsPageSetting;
use App\Models\AdmissionsRequestInfoSetting;
use App\Models\AdmissionsRequestProgram;
use App\Models\AdmissionsRequirement;
use App\Models\AdmissionsRequirementSetting;
use App\Models\AdmissionsTuition;
use App\Models\AdmissionsTuitionSetting;
use Illuminate\View\View;

class CollegeAdmissionsController extends Controller
{
    public function index(): View
    {
        $pageSetting = AdmissionsPageSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $steps = AdmissionsApplicationStep::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $requirementSetting = AdmissionsRequirementSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $requirements = AdmissionsRequirement::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $tuitionSetting = AdmissionsTuitionSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $tuitions = AdmissionsTuition::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $requestInfoSetting = AdmissionsRequestInfoSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $requestPrograms = AdmissionsRequestProgram::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $deadlineSetting = AdmissionsDeadlineSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $deadlines = AdmissionsDeadline::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $campusVisitSetting = AdmissionsCampusVisitSetting::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();

        $campusVisitOptions = AdmissionsCampusVisitOption::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('college.admissions', compact(
            'pageSetting',
            'steps',
            'requirementSetting',
            'requirements',
            'tuitionSetting',
            'tuitions',
            'requestInfoSetting',
            'requestPrograms',
            'deadlineSetting',
            'deadlines',
            'campusVisitSetting',
            'campusVisitOptions'
        ));
    }
}
