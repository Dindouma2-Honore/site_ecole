<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = ['apprenant_id', 'reference', 'libelle', 'montant_total', 'date_emission', 'echeance', 'statut'];

    protected $casts = ['date_emission' => 'date', 'echeance' => 'date'];

    public function apprenant() { return $this->belongsTo(Apprenant::class); }
    public function paiements() { return $this->hasMany(Paiement::class); }

    public function getMontantPayeAttribute()
    {
        return $this->paiements()->sum('montant');
    }

    public function getMontantRestantAttribute()
    {
        return max(0, $this->montant_total - $this->montant_paye);
    }

    public function refreshStatut(): void
    {
        $paye = $this->montant_paye;
        if ($paye <= 0) {
            $statut = 'impayee';
        } elseif ($paye >= $this->montant_total) {
            $statut = 'payee';
        } else {
            $statut = 'partielle';
        }
        $this->update(['statut' => $statut]);
    }
}
