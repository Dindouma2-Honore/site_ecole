<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::whereIn('audience', ['tous', 'parents'])
            ->orderBy('published_at', 'desc')
            ->get();

        return view('parent.announcements', compact('announcements'));
    }
}
