<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Devis extends Model
{

    protected $fillable = [
        'user_id',
        'pdf_path',
        'total_ttc',
        'status',
        'nom',
        'email',
        'telephone',
        'message',
        'expires_at',
        'reference',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Génère une référence unique automatiquement
     */
    protected static function booted()
    {
        static::creating(function ($devis) {
            if (empty($devis->reference)) {
                $devis->reference = 'DEV-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Vérifie si le devis est expiré
     */
    public function isExpired(): bool
    {
        return $this->expires_at && now()->greaterThan($this->expires_at);
    }
}

