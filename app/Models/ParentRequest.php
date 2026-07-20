<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentRequest extends Model
{
    protected $fillable = ['parent_id', 'subject', 'message', 'status'];

    public function parentUser()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
