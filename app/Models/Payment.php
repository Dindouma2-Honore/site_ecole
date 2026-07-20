<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id', 'learner_id', 'amount', 'method', 'paid_at', 'reference'];

    protected $casts = ['paid_at' => 'date'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }
}
