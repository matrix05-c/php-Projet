<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    protected $filable = [
        'numEntree',
        'stockEntree',
        'numProd',
    ];


    public function produits()
    {
        return $this->belongsTo(Produit::class, 'numProd');
    }
}
