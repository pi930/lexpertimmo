<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function latest()
{
    $user = auth()->user();

    $notifications = $user->role === 'Admin'
        ? Notification::latest()->take(5)->get()
        : $user->notifications()->latest()->take(5)->get();

    return $notifications;
}
public function markAsRead(Notification $notification)
{
    // Vérifie que la notification appartient bien à l'Adminconnecté
    if ($notification->admin_id !== auth()->id()) {
        abort(403, 'Accès non autorisé à cette notification.');
    }

    $notification->update(['read' => true]);

    return redirect()->route('Admin.notifications.index')->with('success', 'Notification marquée comme lue.');
}


    public function index()
   {
        $notifications = Notification::where('admin_id', auth()->id())
                                     ->latest()
                                     ->paginate(10);

        return view('Admin.notifications.index', compact('notifications'));
    }
}
