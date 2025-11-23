<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $fillable = ['titre', 'description', 'prix']; // adapte selon ta table
}
