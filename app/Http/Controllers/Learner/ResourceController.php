<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;

        $resources = Resource::with('course')
            ->whereHas('course', fn($q) => $q->where('class_id', $learner->class_id))
            ->orderBy('published_at', 'desc')
            ->get();

        return view('learner.resources', compact('learner', 'resources'));
    }
}
