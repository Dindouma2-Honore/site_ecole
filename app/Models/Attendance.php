<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['learner_id', 'course_id', 'date', 'status', 'justified', 'motif'];

    protected $casts = [
        'date' => 'date',
        'justified' => 'boolean',
    ];

    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
