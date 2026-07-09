<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'image', 'video_url', 'category', 'order', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function getEmbedUrlAttribute()
    {
        if (!$this->video_url) {
            return null;
        }

        if (str_contains($this->video_url, 'youtube.com') || str_contains($this->video_url, 'youtu.be')) {
            preg_match('/(?:v=|youtu\.be\/|embed\/)([a-zA-Z0-9_-]{11})/', $this->video_url, $matches);
            if (!empty($matches[1])) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
        }

        return $this->video_url;
    }
}
