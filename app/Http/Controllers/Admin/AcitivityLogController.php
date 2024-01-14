<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity as ModelsActivity;

class AcitivityLogController extends Controller
{
    public function index() 
    {
        $allActivities = ModelsActivity::all();
        return view('admin.logs.index', compact('allActivities'));
    }
}
