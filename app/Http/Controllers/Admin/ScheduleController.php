<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\Course;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get('class_id');
        $classes = SchoolClass::orderBy('order')->get();

        $query = Schedule::with(['schoolClass', 'course'])
            ->orderByRaw("FIELD(day_of_week,'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')")
            ->orderBy('start_time');

        if ($classId) {
            $query->where('class_id', $classId);
        }

        $schedules = $query->get();

        return view('admin.schedules.index', compact('schedules', 'classes', 'classId'));
    }

    public function create()
    {
        return $this->form(new Schedule());
    }

    public function store(Request $request)
    {
        Schedule::create($this->validateData($request));
        return redirect()->route('admin.schedules.index')->with('success', 'Créneau ajouté avec succès.');
    }

    public function edit($id)
    {
        return $this->form(Schedule::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        Schedule::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.schedules.index')->with('success', 'Créneau mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return back()->with('success', 'Créneau supprimé.');
    }

    private function form($schedule)
    {
        $classes = SchoolClass::orderBy('order')->get();
        $courses = $schedule->class_id ? Course::where('class_id', $schedule->class_id)->get() : collect();
        return view('admin.schedules.form', compact('schedule', 'classes', 'courses'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'course_id' => 'required|exists:courses,id',
            'day_of_week' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'room' => 'nullable|string|max:50',
        ]);
    }
}
