<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Apprenant extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'matricule', 'first_name', 'last_name', 'email', 'password',
        'photo', 'course_id', 'annee_scolaire',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function soumissions()
    {
        return $this->hasMany(SoumissionDevoir::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function notifications()
    {
        return $this->hasMany(NotificationApprenant::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
