<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::whereIn('audience', ['tous', 'apprenants'])
            ->orderBy('published_at', 'desc')
            ->get();

        return view('learner.announcements', compact('announcements'));
    }
}
