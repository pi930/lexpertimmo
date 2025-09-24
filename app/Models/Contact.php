<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
    'nom', 'email', 'telephone', 'rue', 'code_postal', 'ville', 'pays', 'sujet', 'message'
];
}
