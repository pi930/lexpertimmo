<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 🔐 Accesseur pour vérifier si l'utilisateur est admin
    public function getIsAdminAttribute()
    {
        return $this->role === 'admin'; // ou 'is_admin' selon ta base
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 👈 à ajouter si tu veux pouvoir le remplir via formulaire ou factory
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}