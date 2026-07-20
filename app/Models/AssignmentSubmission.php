<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = ['assignment_id', 'learner_id', 'file_path', 'comment', 'submitted_at', 'status', 'grade'];

    protected $casts = ['submitted_at' => 'datetime'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }
}
