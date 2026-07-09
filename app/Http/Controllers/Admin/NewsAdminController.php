<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsAdminController extends Controller
{
    public function index()
    {
        $news = News::with('course')->orderBy('published_at', 'desc')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $courses = Course::orderBy('order')->get();
        return view('admin.news.form', ['item' => new News(), 'courses' => $courses]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité publiée avec succès.');
    }

    public function edit($id)
    {
        $item = News::findOrFail($id);
        $courses = Course::orderBy('order')->get();
        return view('admin.news.form', compact('item', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $item = News::findOrFail($id);
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $item = News::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();

        return back()->with('success', 'Actualité supprimée.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'nullable|exists:courses,id',
            'published_at' => 'required|date',
            'active' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['active'] = $request->boolean('active');
        unset($validated['image']);

        return $validated;
    }
}
