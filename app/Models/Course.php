<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'level', 'description', 'pedagogical_content', 'admission_conditions', 'fee', 'active', 'order'
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
