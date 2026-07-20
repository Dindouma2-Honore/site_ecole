<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
   public function index(Request $request)
{
    $query = GalleryItem::where('active', true)
        ->orderBy('order');


    if ($request->filled('category')) {
        $query->where('album', $request->category);
    }


    $items = $query->get();


    $categories = GalleryItem::where('active', true)
        ->whereNotNull('album')
        ->distinct()
        ->pluck('album');


    return view('site.galerie.index', compact(
        'items',
        'categories'
    ));
}
}
