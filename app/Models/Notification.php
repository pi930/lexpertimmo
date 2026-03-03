<?php

namespace App\Models;

use App\Models\Notification;
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
        'read_at',
    ];

    public function Admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Notifications non lues = read_at NULL
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
