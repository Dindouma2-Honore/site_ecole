<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::orderBy('order')->get();
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.form', ['item' => new GalleryItem()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['media_path'] = $request->file('image')->store('gallery', 'public');
        }
        if ($request->hasFile('video_file')) {
            $data['media_path'] = $request->file('video_file')->store('gallery/videos', 'public');
            $data['video_url'] = null;
        }

        GalleryItem::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Élément ajouté avec succès.');
    }

    public function edit($id)
    {
        return view('admin.gallery.form', ['item' => GalleryItem::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $item = GalleryItem::findOrFail($id);
        $data = $this->validateData($request);

        if ($request->hasFile('image') || $request->hasFile('video_file')) {
            if ($item->media_path) Storage::disk('public')->delete($item->media_path);
        }
        if ($request->hasFile('image')) {
            $data['media_path'] = $request->file('image')->store('gallery', 'public');
        }
        if ($request->hasFile('video_file')) {
            $data['media_path'] = $request->file('video_file')->store('gallery/videos', 'public');
            $data['video_url'] = null;
        } elseif ($request->filled('video_url')) {
            $data['media_path'] = null;
        }

        $item->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Élément mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $item = GalleryItem::findOrFail($id);
        if ($item->media_path) Storage::disk('public')->delete($item->media_path);
        $item->delete();
        return back()->with('success', 'Élément supprimé.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:photo,video',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,webm,mkv|max:51200',
            'album' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
            'image' => 'nullable|image|max:4096',
        ]);

        $validated['active'] = $request->boolean('active');
        $validated['order'] = $validated['order'] ?? 0;
        unset($validated['image'], $validated['video_file']);

        return $validated;
    }
}
