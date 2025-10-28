<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'type',
        'content',
        'url',
        'read',
    ];

    // 🔗 Relation avec l'admin (User)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // ✅ Scope pour récupérer les notifications non lues
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
}