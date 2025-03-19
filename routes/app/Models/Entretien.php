<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    
    protected $filable=[
        'numEntr',
        'numServ',
        'numVoiture',
        'nomClient',
        'created_at'

    ];
    public function services(){
        return $this->belongsTo(Service::class, 'numServ');
    }
}
