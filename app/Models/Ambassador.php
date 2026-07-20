<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    protected $fillable = [
        'name', 'role', 'email', 'phone', 'bio', 'photo', 'active', 'order'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
}
