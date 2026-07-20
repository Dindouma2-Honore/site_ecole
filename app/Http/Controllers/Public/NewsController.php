<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Course;

class NewsController extends Controller
{
    public function index(Request $request)
{
    $query = News::where('active', true)
        ->orderBy('published_at', 'desc');

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    $news = $query->paginate(9)->withQueryString();

    $categories = News::where('active', true)
        ->whereNotNull('category')
        ->distinct()
        ->pluck('category');

    $featured = News::where('active', true)
        ->orderBy('published_at', 'desc')
        ->first();

    $evenements = Event::where('active', true)
    ->where('start_date', '>=', now())
    ->orderBy('start_date')
    ->take(4)
    ->get();

    // Ajouter les formations
    $courses = Course::orderBy('name')->get();

    return view('site.actualites.index', compact(
        'news',
        'categories',
        'featured',
        'evenements',
        'courses'
    ));
}

    public function show($slug)
    {
        $item = News::where('active', true)->where('slug', $slug)->firstOrFail();
        return view('site.actualites.show', compact('item'));
    }
}
