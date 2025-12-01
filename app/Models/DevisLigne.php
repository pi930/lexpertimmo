<?php
namespace App\Models;
use App\Models\Objet;

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
    return $this->belongsTo(Objet::class, 'objet_id');

}
}
