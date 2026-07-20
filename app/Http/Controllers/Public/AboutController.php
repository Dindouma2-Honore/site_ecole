<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Ambassador;
use App\Models\ContentPage;
use App\Models\Learner;

class AboutController extends Controller
{
    public function dossier()
    {
        $page = ContentPage::where('slug', 'dossier-etablissement')->first();
        $stats = [
            'students' => Learner::where('status', 'actif')->count(),
            'teachers' => Ambassador::where('role', 'teacher')->count(),
        ];

        return view('site.presentation.dossier', compact('page', 'stats'));
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
