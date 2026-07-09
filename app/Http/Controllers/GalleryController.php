<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryItem::where('active', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $query = GalleryItem::where('active', true)->orderBy('order');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $items = $query->get();

        return view('site.galerie.index', compact('items', 'categories'));
    }
}
