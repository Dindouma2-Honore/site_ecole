<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'category', 'start_date', 'end_date', 'location', 'image', 'shared_info', 'active'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'shared_info' => 'array',
        'active' => 'boolean',
    ];
}
