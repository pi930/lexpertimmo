<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class IsAdminContactController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'IsAdmin') {
            abort(403);
        }

        $messages = Contact::latest()->paginate(20);
        return view('IsAdmin.contact.index', compact('messages'));
    }

    // Tu pourras ajouter ici : show(), reply(), archive(), destroy()…
}
