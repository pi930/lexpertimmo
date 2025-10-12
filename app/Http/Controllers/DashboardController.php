
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        return view('dashboard');
    }
    public function coordonnees()
{
    $user = auth()->user();
    $isAdmin = $user->is_admin;

    if ($isAdmin) {
        $coordonnees = User::paginate(10);
    } else {
        $coordonnees = null;
    }

    return view('dashboard.coordonnes', [
        'user' => $user,
        'isAdmin' => $isAdmin,
        'coordonnees' => $coordonnees,
    ]);
}
}
