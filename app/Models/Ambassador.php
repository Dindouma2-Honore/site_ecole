<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    protected $fillable = [
        'name', 'role', 'bio', 'photo', 'active', 'order'
    ];
}