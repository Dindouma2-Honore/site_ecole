<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $childrenIds = Auth::user()->children()->pluck('learners.id');

        $documents = Document::with('learner')
            ->whereIn('learner_id', $childrenIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('parent.documents', compact('documents'));
    }
}
