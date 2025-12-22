<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rendezvous extends Model
{
    use HasFactory;

    protected $table = 'rendezvous';

protected $fillable = [
    'user_id','zone','date','travail_heure','bloque',
    'rue','code_postal','ville','statut','notes'
];


protected $casts = [
    'date' => 'datetime',
    'bloque' => 'boolean',
    'travail_heure' => 'integer',

];

       public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function scopeDisponible($query)
    {
        return $query->where('bloque', false);
    }
}



