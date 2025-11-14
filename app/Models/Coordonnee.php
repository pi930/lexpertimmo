<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    use HasFactory;

    /**
     * Champs autorisés à l'assignation de masse
     */
    protected $fillable = [
        'user_id',
        'nom',
        'rue',
        'code_postal',
        'ville',
        'pays',
        'email',
        'phone',
    ];

    /**
     * Relation inverse : une coordonnée appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
