<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Discipline;
use App\Models\ContentPage;

class CursusController extends Controller
{
    public function classes()
    {
        $courses = Course::where('active', true)->orderBy('order')->get();
        $groupedByLevel = $courses->groupBy('level');
        return view('site.cursus.classes', compact('courses', 'groupedByLevel'));
    }

    public function admission()
    {
        $courses = Course::where('active', true)->orderBy('order')->get();
        return view('site.cursus.admission', compact('courses'));
    }

    public function frais()
    {
        $courses = Course::where('active', true)->orderBy('order')->get();
        return view('site.cursus.frais', compact('courses'));
    }

    public function disciplines()
    {
        $disciplines = Discipline::where('active', true)->orderBy('order')->get();
        return view('site.cursus.disciplines', compact('disciplines'));
    }

    public function reglement()
    {
        $page = ContentPage::where('slug', 'reglement-interieur')->first();
        return view('site.cursus.reglement', compact('page'));
    }
}
