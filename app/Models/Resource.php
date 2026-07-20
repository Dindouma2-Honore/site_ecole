<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';

    protected $fillable = ['course_id', 'title', 'file_path', 'type', 'link_url', 'published_at'];

    protected $casts = ['published_at' => 'date'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
