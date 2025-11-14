<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail

{
    use HasFactory, Notifiable;

    // 🔐 Accesseur pour vérifier si l'utilisateur est IsAdmin
    public function getIsIsAdminAttribute()
    {
        return $this->role === 'IsAdmin'; // ou 'is_IsAdmin' selon ta base
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
public function coordonnees()
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
    return $this->hasMany(Notification::class, 'IsAdmin');
}
public function dashboardRoute()
{
    return $this->role === 'IsAdmin' ? 'IsAdmin.dashboard_IsAdmin' : 'user.dashboard';
}
public function dashboardLink(): string
{
    return route($this->dashboardRoute(), ['id' => $this->id]);
}


}