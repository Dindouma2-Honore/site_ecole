<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryAdminController extends Controller
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

        if ($request->input('type') === 'video'
            && !$request->hasFile('video_file')
            && !$request->filled('video_url')) {
            return back()
                ->withErrors(['video_file' => "Merci d'uploader une vidéo depuis l'appareil ou de renseigner un lien YouTube."])
                ->withInput();
        }

        if ($request->input('type') === 'photo' && !$request->hasFile('image')) {
            return back()
                ->withErrors(['image' => "Merci de sélectionner une image."])
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('gallery/videos', 'public');
            $data['video_url'] = null;
        }

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Élément ajouté avec succès.');
    }

    public function edit($id)
    {
        $item = GalleryItem::findOrFail($id);
        return view('admin.gallery.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = GalleryItem::findOrFail($id);
        $data = $this->validateData($request);

        $hasVideo = $request->hasFile('video_file') || $request->filled('video_url') || $item->video_file || $item->video_url;
        if ($request->input('type') === 'video' && !$hasVideo) {
            return back()
                ->withErrors(['video_file' => "Merci d'uploader une vidéo depuis l'appareil ou de renseigner un lien YouTube."])
                ->withInput();
        }

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        if ($request->hasFile('video_file')) {
            if ($item->video_file) {
                Storage::disk('public')->delete($item->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('gallery/videos', 'public');
            $data['video_url'] = null;
        } elseif ($request->filled('video_url')) {
            // Un lien YouTube a été saisi : on abandonne l'éventuel fichier local existant.
            if ($item->video_file) {
                Storage::disk('public')->delete($item->video_file);
            }
            $data['video_file'] = null;
        }

        $item->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Élément mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $item = GalleryItem::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        if ($item->video_file) {
            Storage::disk('public')->delete($item->video_file);
        }
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
            'category' => 'nullable|string|max:100',
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
