<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::with('course.schoolClass')->orderBy('published_at', 'desc')->get();
        return view('admin.resources.index', compact('resources'));
    }

    public function create()
    {
        return $this->form(new Resource());
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('resources', 'public');
        }
        Resource::create($data);
        return redirect()->route('admin.resources.index')->with('success', 'Ressource ajoutée avec succès.');
    }

    public function edit($id)
    {
        return $this->form(Resource::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $resource = Resource::findOrFail($id);
        $data = $this->validateData($request);
        if ($request->hasFile('file_path')) {
            if ($resource->file_path) Storage::disk('public')->delete($resource->file_path);
            $data['file_path'] = $request->file('file_path')->store('resources', 'public');
        }
        $resource->update($data);
        return redirect()->route('admin.resources.index')->with('success', 'Ressource mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);
        if ($resource->file_path) Storage::disk('public')->delete($resource->file_path);
        $resource->delete();
        return back()->with('success', 'Ressource supprimée.');
    }

    private function form($resource)
    {
        $courses = Course::with('schoolClass')->orderBy('name')->get();
        return view('admin.resources.form', compact('resource', 'courses'));
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video,lien',
            'link_url' => 'nullable|url',
            'file_path' => 'nullable|file|max:20480',
            'published_at' => 'required|date',
        ]);
        unset($validated['file_path']);
        return $validated;
    }
}
