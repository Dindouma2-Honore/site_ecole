<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\ParentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $requests = ParentRequest::where('parent_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('parent.requests', compact('requests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['parent_id'] = Auth::id();
        ParentRequest::create($validated);

        return back()->with('success', 'Votre demande a bien été envoyée.');
    }
}
