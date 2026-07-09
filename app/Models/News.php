<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = ['title', 'content', 'image', 'course_id', 'published_at', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function scopeGenerale($query)
    {
        return $query->whereNull('course_id');
    }

    public function scopePourClasse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }
}
