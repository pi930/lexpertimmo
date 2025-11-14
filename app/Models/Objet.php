<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Objet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'description', 'prix_unitaire_ht'
    ];

    public function lignesDevis()
    {
        return $this->hasMany(DevisLigne::class);
    }
}