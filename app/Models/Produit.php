<?php
namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $filable = [
        'numProd',
        'design',
        'stock',
        'prixProduit'
    ];
    public $timestamps = false;
    protected $primaryKey = 'numProd';

    public function entrees()
    {
          return $this->hasMany(Entree::class, 'numProd');
    }
   

    public function achats()
    {
          return $this->hasMany(Achat::class, 'numProd');
    }
}
