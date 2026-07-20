<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['learner_id', 'academic_year_id', 'reference', 'label', 'amount', 'due_date', 'status'];

    protected $casts = ['due_date' => 'date'];

    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPaidAmountAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getRemainingAmountAttribute()
    {
        return max(0, $this->amount - $this->paid_amount);
    }

    public function refreshStatus(): void
    {
        $paid = $this->paid_amount;
        if ($paid >= $this->amount) {
            $status = 'payee';
        } elseif ($this->due_date->isPast() && $paid < $this->amount) {
            $status = 'en_retard';
        } else {
            $status = 'en_attente';
        }
        $this->update(['status' => $status]);
    }
}
