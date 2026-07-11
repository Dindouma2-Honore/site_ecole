<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoumissionDevoir extends Model
{
    protected $table = 'soumissions_devoirs';

    protected $fillable = ['devoir_id', 'apprenant_id', 'fichier_joint', 'commentaire', 'date_soumission', 'statut', 'note'];

    protected $casts = ['date_soumission' => 'datetime'];

    public function devoir() { return $this->belongsTo(Devoir::class); }
    public function apprenant() { return $this->belongsTo(Apprenant::class); }
}
