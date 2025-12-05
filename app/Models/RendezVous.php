<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    protected $table = 'rendezvous'; // 👈 force le nom correct

    protected $fillable = [
        'user_id',
        'rue',
        'code_postal',
        'ville',
        'date',
        'travail_heure',
        'bloque',
    ];

    protected $casts = [
        'date' => 'datetime', // 👈 important pour pouvoir utiliser ->format()
        'bloque' => 'boolean',
    ];

    public function scopeDisponible($query)
    {
        return $query->where('bloque', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

