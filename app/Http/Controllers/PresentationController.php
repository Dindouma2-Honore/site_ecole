<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use App\Models\ContentPage;

class PresentationController extends Controller
{
    public function dossier()
    {
        $page = ContentPage::where('slug', 'dossier-etablissement')->first();
        return view('site.presentation.dossier', compact('page'));
    }

    public function histoire()
    {
        $page = ContentPage::where('slug', 'historique')->first();
        return view('site.presentation.histoire', compact('page'));
    }

    public function visionMission()
    {
        $page = ContentPage::where('slug', 'vision-mission')->first();
        return view('site.presentation.vision-mission', compact('page'));
    }

    public function equipe()
    {
        $membres = Ambassador::where('active', true)->orderBy('order')->get();
        return view('site.presentation.equipe', compact('membres'));
    }
}
