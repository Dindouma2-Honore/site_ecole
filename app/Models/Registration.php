<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'course_id',
        'birth_date', 'address', 'parent_name', 'parent_phone',
        'status', 'validated_at'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}