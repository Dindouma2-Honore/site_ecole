<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'birth_date', 'gender', 'cycle_souhaite',
        'class_souhaitee_id', 'parent_name', 'parent_email', 'parent_phone',
        'address', 'previous_school', 'status', 'admin_notes', 'processed_by', 'processed_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'processed_at' => 'datetime',
    ];

    public function classeSouhaitee()
    {
        return $this->belongsTo(SchoolClass::class, 'class_souhaitee_id');
    }

    public function documents()
    {
        return $this->hasMany(RegistrationDocument::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
