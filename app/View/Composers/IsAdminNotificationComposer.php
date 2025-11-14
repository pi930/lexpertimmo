<?php

namespace App\View\Composers;


use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class IsAdminNotificationComposer
{
    public function compose(View $view): void
    {
        $unreadCount = 0;
        $latestNotifications = collect();

        if (Auth::check() && Auth::user()->role === 'IsAdmin') {
            $unreadCount = Notification::where('IsAdmin_id', Auth::id())
                                       ->where('read', false)
                                       ->count();

            $latestNotifications = Notification::where('IsAdmin_id', Auth::id())
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