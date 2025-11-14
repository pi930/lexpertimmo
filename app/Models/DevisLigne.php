<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevisLigne extends Model
{
    protected $fillable = [
        'devis_id',
        'objet_id',
        'designation',
        'quantite',
        'prix_unitaire_ht',
        'tva',
        'total_ttc',
    ];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }

public function objet()
{
    return $this->belongsTo(\App\Models\Objet::class);
}
}