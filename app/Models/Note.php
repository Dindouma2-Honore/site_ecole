<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['evaluation_id', 'apprenant_id', 'valeur', 'appreciation'];

    public function evaluation() { return $this->belongsTo(Evaluation::class); }
    public function apprenant() { return $this->belongsTo(Apprenant::class); }
}
