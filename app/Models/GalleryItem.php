<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'image', 'video_url', 'video_file', 'category', 'order', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Indique d'où vient la vidéo : 'local' (fichier uploadé) ou 'youtube' (lien).
     */
    public function getVideoSourceAttribute()
    {
        if ($this->video_file) {
            return 'local';
        }

        if ($this->video_url) {
            return 'youtube';
        }

        return null;
    }

    /**
     * URL prête à être utilisée dans le lecteur (fichier uploadé ou vidéo YouTube intégrée).
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->video_file) {
            return Storage::url($this->video_file);
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
