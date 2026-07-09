<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'icon', 'order', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];
}
