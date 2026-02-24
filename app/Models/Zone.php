<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = [
    'nom',
    'latitude',
    'longitude',
    'rayon_km',
];

}

