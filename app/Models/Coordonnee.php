<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    protected $table = 'coordonnees'; // table en base

   protected $fillable = [
    'nom',
    'rue',
    'telephone',
    'ville',
    'code_postal',
    'pays',
    'email',
    'user_id',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}