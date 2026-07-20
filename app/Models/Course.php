<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'class_id', 'name', 'slug', 'teacher_name', 'teacher_id',
        'description', 'color', 'coefficient',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Ambassador::class, 'teacher_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
