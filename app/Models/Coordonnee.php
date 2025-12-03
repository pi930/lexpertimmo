<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    protected $table = 'coordonnees'; // table en base

    protected $fillable = [
        'user_id',
        'last_name',
        'rue',
        'email',
        'telephone',
        'code_postal',
        'ville',
        'pays',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}