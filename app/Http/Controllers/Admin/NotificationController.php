<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
public function markAsRead(Notification $notification)
{
    // Vérifie que la notification appartient bien à l'admin connecté
    if ($notification->admin_id !== auth()->id()) {
        abort(403, 'Accès non autorisé à cette notification.');
    }

    $notification->update(['read' => true]);

    return redirect()->route('admin.notifications.index')->with('success', 'Notification marquée comme lue.');
}


    public function index()
   {
        $notifications = Notification::where('admin_id', auth()->id())
                                     ->latest()
                                     ->paginate(10);

        return view('admin.notifications.index', compact('notifications'));
    }
}