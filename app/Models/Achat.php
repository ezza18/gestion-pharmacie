<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $fillable = [
        'produit_id',
        'fournisseur',
        'quantite_achetee',
        'prix_unitaire',
        'total',
        'date_achat',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}