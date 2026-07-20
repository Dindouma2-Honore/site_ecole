<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'school_classes';

    protected $fillable = [
        'name', 'cycle', 'level', 'academic_year_id', 'capacity',
        'description', 'pedagogical_content', 'admission_conditions',
        'fee', 'active', 'order',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function learners()
    {
        return $this->hasMany(Learner::class, 'class_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'class_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }
}
