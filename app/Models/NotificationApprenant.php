<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationApprenant extends Model
{
    protected $table = 'notifications_apprenant';

    protected $fillable = ['apprenant_id', 'course_id', 'titre', 'message', 'type', 'lu'];

    protected $casts = ['lu' => 'boolean'];

    public function apprenant() { return $this->belongsTo(Apprenant::class); }
    public function course() { return $this->belongsTo(Course::class); }
}
