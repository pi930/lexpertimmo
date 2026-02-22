<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function index()
    {
        if (!Auth::check() || strtolower(Auth::user()->role) !== 'admin') {
            abort(403);
        }

        $messages = Contact::latest()->paginate(20);
        return view('admin.contact.index', compact('messages'));
    }

    public function destroy($id)
    {
        if (!Auth::check() || strtolower(Auth::user()->role) !== 'admin') {
            abort(403);
        }

        $message = Contact::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Message supprimé avec succès.');
    }
}
