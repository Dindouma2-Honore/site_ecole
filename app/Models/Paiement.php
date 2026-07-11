<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = ['facture_id', 'montant', 'date_paiement', 'mode_paiement', 'reference_transaction'];

    protected $casts = ['date_paiement' => 'date'];

    public function facture() { return $this->belongsTo(Facture::class); }
}
