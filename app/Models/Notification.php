<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'IsAdmin_id',
        'type',
        'content',
        'url',
        'read',
    ];

    // 🔗 Relation avec l'IsAdmin (User)
    public function IsAdmin()
    {
        return $this->belongsTo(User::class, 'IsAdmin_id');
    }

    // ✅ Scope pour récupérer les notifications non lues
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
}