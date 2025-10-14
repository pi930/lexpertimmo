<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'rue',
        'code_postal',
        'ville',
        'email',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
