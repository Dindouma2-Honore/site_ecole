<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $albums = GalleryItem::where('active', true)->whereNotNull('album')->distinct()->pluck('album');

        $query = GalleryItem::where('active', true)->orderBy('order');

        if ($request->filled('album') && $request->album !== 'all') {
            $query->where('album', $request->album);
        }

        $items = $query->get();

        return view('site.galerie.index', compact('items', 'albums'));
    }
}
