<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $evenement = Event::orderBy('start_date', 'desc')->get();
        return view('admin.evenements.index', compact('evenement'));
    }

    public function create()
    {
        return view('admin.evenements.form', ['evenement' => new Event()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(4);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('evenements', 'public');
        }
        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Événement ajouté avec succès.');
    }

    public function edit($id)
    {
        return view('admin.evenements.form', ['evenement' => Event::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk('public')->delete($event->image);
            $data['image'] = $request->file('image')->store('evenements', 'public');
        }
        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->image) Storage::disk('public')->delete($event->image);
        $event->delete();
        return back()->with('success', 'Événement supprimé.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->boolean('active');
        unset($validated['image']);

        return $validated;
    }
}
