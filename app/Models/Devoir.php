<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
{
    protected $fillable = ['discipline_id', 'course_id', 'titre', 'description', 'fichier_joint', 'date_publication', 'date_limite'];

    protected $casts = ['date_publication' => 'date', 'date_limite' => 'date'];

    public function discipline() { return $this->belongsTo(Discipline::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function soumissions() { return $this->hasMany(SoumissionDevoir::class); }
}
