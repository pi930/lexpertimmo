<?php

namespace App\Http\Controllers\IsAdmin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
public function markAsRead(Notification $notification)
{
    // Vérifie que la notification appartient bien à l'IsAdmin connecté
    if ($notification->IsAdmin_id !== auth()->id()) {
        abort(403, 'Accès non autorisé à cette notification.');
    }

    $notification->update(['read' => true]);

    return redirect()->route('IsAdmin.notifications.index')->with('success', 'Notification marquée comme lue.');
}


    public function index()
   {
        $notifications = Notification::where('IsAdmin_id', auth()->id())
                                     ->latest()
                                     ->paginate(10);

        return view('IsAdmin.notifications.index', compact('notifications'));
    }
}