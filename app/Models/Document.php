<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['learner_id', 'title', 'file_path', 'category', 'uploaded_by'];

    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
