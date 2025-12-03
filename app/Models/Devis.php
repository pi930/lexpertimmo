<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'reference', 'pdf_path', 'total_ttc', 'expires_at',
        'status', 'nom', 'email', 'telephone', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function devisLignes()
{
    return $this->hasMany(\App\Models\DevisLigne::class);
}
// App\Models\Devis.php
public function prestations()
{
    return $this->belongsToMany(Prestation::class, 'devis_prestations')
                ->withPivot(['quantite', 'prix_unitaire_ht', 'tva', 'total_ttc']);
}
}
