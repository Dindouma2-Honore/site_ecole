<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['learner_id', 'course_id', 'term', 'title', 'score', 'max_score', 'coefficient', 'comment'];

    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getScoreSur20Attribute()
    {
        return $this->max_score > 0 ? round(($this->score / $this->max_score) * 20, 2) : 0;
    }
}
