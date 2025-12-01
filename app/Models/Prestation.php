<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $fillable = ['titre', 'description', 'prix']; // adapte selon ta table
    public function devis()
{
    return $this->belongsToMany(Devis::class, 'devis_prestations')
                ->withPivot(['quantite', 'prix_unitaire_ht', 'tva', 'total_ttc']);
}
}
