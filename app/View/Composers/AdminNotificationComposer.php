<?php

namespace App\View\Composers;


use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AdminNotificationComposer
{
    public function compose(View $view): void
    {
        $unreadCount = 0;
        $latestNotifications = collect();

        if (Auth::check() && Auth::user()->role === 'admin') {
            $unreadCount = Notification::where('admin_id', Auth::id())
                                       ->where('read', false)
                                       ->count();

            $latestNotifications = Notification::where('admin_id', Auth::id())
                                               ->latest()
                                               ->take(5)
                                               ->get();
        }

        $view->with([
            'unreadCount' => $unreadCount,
            'latestNotifications' => $latestNotifications,
        ]);
    }
}