<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{   
    protected $primaryKey = 'numAchat';
    protected $filable = [
        'numAchat',
        'numProd',
        'nomClient',
        'nbrLitre',
    ];

    public function produits(){
        return $this->belongsTo(Produit::class, 'numProd');
    }
}
