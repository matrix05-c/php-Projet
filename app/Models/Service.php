<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'numServ';
    protected $filable = [
        'numServ',
        'service',
        'prix',
    ];
    public function entretien()
    {
        return $this->hasMany(Entretien::class, 'numServ');
    }
}
