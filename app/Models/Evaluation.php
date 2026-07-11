<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['discipline_id', 'course_id', 'titre', 'type', 'date_evaluation', 'coefficient', 'bareme'];

    protected $casts = ['date_evaluation' => 'date'];

    public function discipline() { return $this->belongsTo(Discipline::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function notes() { return $this->hasMany(Note::class); }
}
