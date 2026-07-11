<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploiTemps extends Model
{
    protected $table = 'emplois_temps';

    protected $fillable = ['course_id', 'discipline_id', 'enseignant_id', 'jour', 'heure_debut', 'heure_fin', 'salle'];

    public function course() { return $this->belongsTo(Course::class); }
    public function discipline() { return $this->belongsTo(Discipline::class); }
    public function enseignant() { return $this->belongsTo(Ambassador::class, 'enseignant_id'); }
}
