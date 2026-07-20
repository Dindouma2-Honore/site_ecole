<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'image', 'category', 'published_at', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'date',
    ];
}
