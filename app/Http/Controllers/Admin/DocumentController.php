<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('learner')->orderBy('created_at', 'desc')->get();
        $learners = Learner::orderBy('last_name')->get();
        return view('admin.documents.index', compact('documents', 'learners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'learner_id' => 'required|exists:learners,id',
            'title' => 'required|string|max:255',
            'category' => 'required|in:bulletin,certificat,autre',
            'file' => 'required|file|max:10240',
        ]);

        $validated['file_path'] = $request->file('file')->store('documents', 'public');
        $validated['uploaded_by'] = Auth::id();
        unset($validated['file']);

        Document::create($validated);

        return back()->with('success', 'Document ajouté avec succès.');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return back()->with('success', 'Document supprimé.');
    }
}
