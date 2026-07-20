<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;
        $documents = $learner->documents()->orderBy('created_at', 'desc')->get();

        return view('learner.documents', compact('learner', 'documents'));
    }
}
