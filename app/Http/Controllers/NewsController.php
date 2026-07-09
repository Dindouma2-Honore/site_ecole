<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Course;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::where('active', true)->orderBy('order')->get();

        $query = News::where('active', true)->with('course')->orderBy('published_at', 'desc');

        if ($request->filled('course_id')) {
            if ($request->course_id === 'generale') {
                $query->whereNull('course_id');
            } else {
                $query->where('course_id', $request->course_id);
            }
        }

        $news = $query->paginate(9)->withQueryString();

        return view('site.actualites.index', compact('news', 'courses'));
    }

    public function show($id)
    {
        $item = News::where('active', true)->with('course')->findOrFail($id);
        return view('site.actualites.show', compact('item'));
    }
}
