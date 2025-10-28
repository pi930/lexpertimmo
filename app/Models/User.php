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
        return $this->role === 'isAdmin'; // ou 'is_admin' selon ta base
    }

    protected $fillable = [
        'nom',
        'rue',
        'code_postal',
        'ville',
        'pays',
        'email',
        'phone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
public function coordonnee()
{
    return $this->hasOne(Coordonnee::class);
}

public function contacts()
{
    return $this->hasMany(Contact::class);
}

public function devis()
{
    return $this->hasMany(Devis::class);
}

public function rendezvous()
{
    return $this->hasMany(RendezVous::class);
}

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function notifications()
{
    return $this->hasMany(Notification::class, 'admin_id');
}
}