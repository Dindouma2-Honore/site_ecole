<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', ['item' => new News()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(4);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);
        return redirect()->route('admin.news.index')->with('success', 'Actualité publiée avec succès.');
    }

    public function edit($id)
    {
        return view('admin.news.form', ['item' => News::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $item = News::findOrFail($id);
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            if ($item->image) Storage::disk('public')->delete($item->image);
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $item->update($data);
        return redirect()->route('admin.news.index')->with('success', 'Actualité mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $item = News::findOrFail($id);
        if ($item->image) Storage::disk('public')->delete($item->image);
        $item->delete();
        return back()->with('success', 'Actualité supprimée.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'body' => 'required|string',
            'category' => 'nullable|string|max:100',
            'published_at' => 'required|date',
            'active' => 'nullable|boolean',
            'image' => 'nullable|image|max:4096',
        ]);

        $validated['active'] = $request->boolean('active');
        unset($validated['image']);

        return $validated;
    }
}
