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

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
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

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
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
        $item->delete();

        return back()->with('success', 'Élément supprimé.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:photo,video',
            'video_url' => 'nullable|url|required_if:type,video',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
            'image' => 'nullable|image|max:4096|required_if:type,photo',
        ]);

        $validated['active'] = $request->boolean('active');
        $validated['order'] = $validated['order'] ?? 0;

        unset($validated['image']);

        return $validated;
    }
}
