<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Ambassador;
use App\Models\SchoolClass;
use App\Models\Learner;

class HomeController extends Controller
{
    public function index()
    {
        $ambassadors = Ambassador::where('active', true)->take(3)->get();
        $classes = SchoolClass::where('active', true)->take(4)->get();
        $stats = [
            'students' => Learner::where('status', 'actif')->count(),
            'teachers' => Ambassador::where('role', 'teacher')->count(),
            'classes' => SchoolClass::count(),
        ];

        return view('site.home', compact('ambassadors', 'classes', 'stats'));
    }
}
