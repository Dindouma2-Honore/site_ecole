<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('active', true)->orderBy('start_date')->get();
        return view('parent.events', compact('events'));
    }
}
