<?php

namespace App\Models;

use App\Models\Rendezvous;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail

{
    use HasFactory, Notifiable;

    // 🔐 Accesseur pour vérifier si l'utilisateur est Admin
    public function getIsAdminAttribute()
    {
        return $this->role === 'Admin'; // ou 'is_Admin' selon ta base
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
  // Exemple : relation 1–1
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

public function messages()
{
    return $this->hasMany(Message::class);
}
public function dashboardView()
{
    return $this->role === 'Admin' ? 'Admin.dashboard_Admin' : 'Admin.dashboard_user';
}
public function dashboardLink(): string
{
    return $this->role === 'Admin'
        ? route('admin.dashboard')
        : route('user.dashboard', ['id' => $this->id]);
}

}
