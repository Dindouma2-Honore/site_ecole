<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use Illuminate\Http\Request;

class ContentPageController extends Controller
{
    public function index()
    {
        $pages = ContentPage::orderBy('title')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = ContentPage::findOrFail($id);
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = ContentPage::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page mise à jour avec succès.');
    }
}
