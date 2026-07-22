<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Course;

use App\Models\ContentPage;

class ProgramController extends Controller
{
    public function classes()
    {
        $classes = SchoolClass::where('active', true)->orderBy('order')->get();
        
        $groupedByCycle = $classes->groupBy('cycle');
        return view('site.cursus.classes', compact('classes','courses', 'groupedByCycle'));
    }

 public function admission()
{
    $classes = SchoolClass::where('active', true)
        ->orderBy('order')
        ->get();

    $courses = Course::orderBy('name')->get();

    return view(
        'site.cursus.admission',
        compact('classes', 'courses')
    );
}

    public function frais()
    {
        $classes = SchoolClass::where('active', true)->orderBy('order')->get();
        $courses = Course::orderBy('name')->get();
        return view('site.cursus.frais', compact('classes','courses'));
    }

    public function disciplines()
    {
        // Liste des matières distinctes enseignées, tous niveaux confondus
        $disciplines = Course::select('name')
            ->distinct()
            ->orderBy('name')
            ->get();

        return view('site.cursus.disciplines', compact('disciplines'));
    }

    public function reglement()
    {
        $page = ContentPage::where('slug', 'reglement-interieur')->first();
        return view('site.cursus.reglement', compact('page'));
    }
}
