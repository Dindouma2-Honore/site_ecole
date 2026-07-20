<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    protected $fillable = ['title', 'media_path', 'video_url', 'type', 'album', 'order', 'active'];

    protected $casts = ['active' => 'boolean'];

    public function getVideoSourceAttribute()
    {
        if ($this->type === 'video' && $this->media_path) return 'local';
        if ($this->type === 'video' && $this->video_url) return 'youtube';
        return null;
    }

    public function getEmbedUrlAttribute()
    {
        if ($this->type === 'video' && $this->media_path) {
            return Storage::url($this->media_path);
        }

        if ($this->video_url) {
            if (str_contains($this->video_url, 'youtube.com') || str_contains($this->video_url, 'youtu.be')) {
                preg_match('/(?:v=|youtu\.be\/|embed\/)([a-zA-Z0-9_-]{11})/', $this->video_url, $matches);
                if (!empty($matches[1])) {
                    return 'https://www.youtube.com/embed/' . $matches[1];
                }
            }
            return $this->video_url;
        }

        return null;
    }
}
